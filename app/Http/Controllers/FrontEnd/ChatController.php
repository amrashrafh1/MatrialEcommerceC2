<?php

namespace App\Http\Controllers\FrontEnd;

use App\Conversation;
use App\Events\SendMesseges;
use App\Events\StatusEvent;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function seller($slug)
    {
        $user_id = $slug;
        $auth_id = auth()->user()->id;
        if ($slug === auth()->user()->id) {return redirect()->route('home');};
        $conversation = Conversation::where('id', $user_id)->first();

        // if conversation exist
        if ($conversation) {
            event(new StatusEvent(auth()->user()));
            return view('FrontEnd.chat', ['conv' => $conversation]);

            // if conversation does not exist
        } else {
            // find product by slug
            $product = Product::where('slug', $user_id)->first();

            // if product exist
            if ($product) {
                if ($product->user_id === auth()->user()->id) {return redirect()->route('home');};
                // check if the last url (route('show_product', $slug))

                if (url()->previous() === route('show_product', $slug)) {

                    // find the conversation from product user_id but if not find create conversation

                    $conversationProduct = Conversation::where('user_1', $auth_id)->where('user_2', $product->user_id)
                        ->orWhere('user_1', $product->user_id)->where('user_2', $auth_id)
                        ->firstOrCreate([
                            'user_1' => $auth_id,
                            'user_2' => $product->user_id,
                        ]);
                    // if conversation exist
                    if ($conversationProduct) {

                        // create message with product to seller
                        $conversationProduct->messages()->create([
                            'message' => 'product',
                            'product_id' => $product->id,
                            'm_to' => intval($product->user_id),
                            'm_from' => auth()->user()->id,
                        ]);

                        event(new StatusEvent(auth()->user()));
                        return view('FrontEnd.chat', ['conv' => $conversationProduct]);

                    }
                }
            } else {
                return redirect()->route('chat');
            }
        }

    }

    public function customer($slug)
    {
        $user_id = Product::where('slug', $slug)->first();
        if ($user_id) {
            event(new StatusEvent(auth()->user()));

            return view('FrontEnd.chat', ['user_id' => $user_id->seller->id]);
        } else {
            return redirect()->route('home');
        }
    }

    public function chat()
    {
        $auth_id = auth()->user()->id;
        $conversation = Conversation::where('user_1', $auth_id)
            ->orWhere('user_2', $auth_id)->first();

        if ($conversation) {
            event(new StatusEvent(auth()->user()));
            return view('FrontEnd.chat', ['conv' => $conversation]);
        } else {

            if (auth()->user()->hasRole('seller')) {
                $user_id = User::whereRoleIs('user')->first()->id;
            } else {
                $user_id = User::whereRoleIs('seller')->first()->id;
            }

            $conversation = Conversation::create([
                'user_1' => $auth_id,
                'user_2' => $user_id,
            ]);
            event(new StatusEvent(auth()->user()));
            return view('FrontEnd.chat', ['conv' => $conversation]);

        }

    }

    public function sendMessage(Request $request, $id)
    {
        //return $request->all();
        $data = $this->validate(request(), [
            // 'message'  => 'sometimes|nullable|string|min:1|max:255',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
        ], [], [
            // 'message'  => trans('user.message'),
            'images.*' => trans('user.images'),
        ]);
        // get conversation
        $conv = Conversation::where('id', $id)->first();
        if ($conv) {

            // get the user id
            $user_id = ($conv->user_1 != auth()->user()->id) ? $conv->user_1 : $conv->user_2;

            if ($data['images'] && $user_id) {
                $message = $conv->messages()->create([
                    'message' => 'images only',
                    'm_to'    => $user_id,
                    'm_from'  => auth()->user()->id,
                ]);
                multiple_uploads($data['images'], 'messages', $message);

                broadcast(new SendMesseges($message, $conv->id))->toOthers();

                return 'success';
            }
        }
    }
}
