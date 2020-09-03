<?php

namespace App\Http\Controllers\FrontEnd;

use App\Events\SendMesseges;
use App\Events\StatusEvent;
use App\Http\Controllers\Controller;
use App\Message;
use App\Product;
use App\User;
use App\Conversation;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function seller($slug)
    {
        $user_id = $slug;
        $auth_id = auth()->user()->id;
        if($slug === auth()->user()->id){return redirect()->route('home');};
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
                if($product->user_id === auth()->user()->id){return redirect()->route('home');};
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
                            'message'    => 'product',
                            'product_id' => $product->id,
                            'm_to'       => intval($product->user_id),
                            'm_from'     => auth()->user()->id,
                        ]);

                        event(new StatusEvent(auth()->user()));
                        return view('FrontEnd.chat', ['conv' => $conversationProduct]);

                    }

                    /* else {
                    $conv = Conversation::create([
                    'user_1' => $auth_id,
                    'user_2' => $product->seller_id
                    ]);
                    $conv->messages()->create([
                    'message'    => 'product',
                    'product_id' => $product->id,
                    'm_to'       => intval($product->seller->id),
                    'm_from'     => auth()->user()->id,
                    ]);

                    event(new StatusEvent(auth()->user()));
                    return view('FrontEnd.chat', ['conv' => $conv]);
                    } */
                    /*     return $this->customer($user_id);
                } else {

                return $this->customer($user_id);
                } */
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
        //return $data;
        $user = User::where('id', $id)->first();
        if ($data['images'] && $user) {
            $message = Message::create([
                'message' => 'images only',
                'm_to' => $user->id,
                'm_from' => auth()->user()->id,
            ]);
            multiple_uploads($data['images'], 'messages', $message);
            /* $images = [];
            foreach($message->files->pluck('file') as $file) {
            array_push($images, \Storage::url($file));
            } */
            if (auth()->user()->hasRole('seller')) {
                broadcast(new SendMesseges($message, auth()->user()->id, $id))->toOthers();
            } else {
                broadcast(new SendMesseges($message, $id, auth()->user()->id))->toOthers();
            }
            return 'success';
        }

    }
}
