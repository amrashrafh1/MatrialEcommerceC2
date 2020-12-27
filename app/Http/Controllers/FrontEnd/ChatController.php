<?php

namespace App\Http\Controllers\FrontEnd;

use App\Conversation;
use App\Events\SendMesseges;
use App\Events\StatusEvent;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Crypt;
use Illuminate\Http\Request;

class ChatController extends Controller
{


    public function chat(Request $request)
    {

        $data = $this->validate(request(), [
            'memberTypeTo' => 'required|string|in:seller,member,chat',
            'seq'          => 'required|string'
        ]);
        $memberTypeTo = $data['memberTypeTo'];
        $seq          = $data['seq'];

        if($memberTypeTo == 'seller') {
            return $this->toSeller($seq);
        } elseif($memberTypeTo == 'member') {
            return $this->toMember($seq);

        } elseif($memberTypeTo == 'chat') {
            return $this->toChat();

        } else {return redirect()->route('home');}

    }

    public function customer($slug)
    {
        $user_id = Product::where('slug', $slug)->first();
        if ($user_id) {
            event(new StatusEvent(auth()->user()));

            return view('FrontEnd.chat', ['user_id' => $user_id->store->id]);
        } else {
            return redirect()->route('home');
        }
    }

    /* public function chat()
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

    } */

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

    public function getConversation($auth_id, $seq) {
        $conversation = Conversation::where('user_1', $auth_id)
            ->where('user_2', $seq)
            ->orWhere('user_1', $seq)->where('user_2', $auth_id)->orderBy('id', 'desc')
            ->firstOrCreate([
                'user_1' => $auth_id,
                'user_2' => $seq,
        ]);

        return $conversation;
    }

    public function toMember($seq) {
        $auth_id      = auth()->user()->id;
        $user_id      = Crypt::decrypt($seq);
        $conversation = $this->getConversation($auth_id, $user_id);
        event(new StatusEvent(auth()->user()));
        return view('FrontEnd.chat', ['conv' => $conversation]);
    }
    public function toChat() {
        $auth_id      = auth()->user()->id;
        $conversation = Conversation::where('user_1', $auth_id)
        ->orWhere('user_2', $auth_id)
        ->orderBy('id', 'desc')->first();

        if($conversation) {
            event(new StatusEvent(auth()->user()));
            return view('FrontEnd.chat', ['conv' => $conversation]);
        } else {return redirect()->route('home');}
    }

    public function toSeller($seq) {
        $product = Product::where('slug', $seq)->first();
            // if product exist
        if ($product) {
            if ($product->user_id === auth()->user()->id) {return redirect()->route('home');};

            $auth_id      = auth()->user()->id;
            $conversation = $this->getConversation($auth_id, $product->user_id);
            $is_product = $conversation->messages->where('product_id', $product->id)->first();
            if(!$is_product) {
                $message = $conversation->messages()->create([
                    'm_from'     => $auth_id,
                    'm_to'       => $product->user_id,
                    'message'    => 'product',
                    'product_id' => $product->id,
                    'conv_id'    => $conversation->id
                ]);
            }
            event(new StatusEvent(auth()->user()));
            return view('FrontEnd.chat', ['conv' => $conversation]);
        } else {return redirect()->route('home');}
    }
}
