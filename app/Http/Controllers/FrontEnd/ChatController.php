<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\StatusEvent;
use App\Events\SendMesseges;

use App\User;
use App\Product;
use App\Message;
class ChatController extends Controller
{
    public function seller($slug) {
        $user_id = \Crypt::decrypt($slug);
            $user = User::where('id', $user_id)->first();
            if($user) {
                event(new StatusEvent(auth()->user()));
                return view('FrontEnd.chat', ['user_id'=> $user->id]);
            } elseif(!$user) {
                $product = Product::where('slug', $user_id)->first();
                if($product) {
                    if(url()->previous() === route('show_product', $slug)) {
                        auth()->user()->messages()->create([
                            'message' => 'product',
                            'product_id' => $product->id,
                            'm_to'    => intval($product->seller->id),
                            'm_from'  => auth()->user()->id,
                        ]);
                        return $this->customer($user_id);
                    } else {

                        return $this->customer($user_id);
                    }
                }
                } else {
                    return redirect()->route('home');
                }

    }

    public function customer ($slug) {
        $user_id = Product::where('slug', $slug)->first();
        if($user_id) {
            event(new StatusEvent(auth()->user()));

        return view('FrontEnd.chat', ['user_id'=> $user_id->seller->id]);
        } else {
            return redirect()->route('home');
        }
    }

    public function chat () {
        $last = auth()->user()->messages->last();
        if($last) {
            event(new StatusEvent(auth()->user()));
            return view('FrontEnd.chat', ['user_id'=> $last->m_to]);
        } else {

            if(auth()->user()->hasRole('seller')) {
                event(new StatusEvent(auth()->user()));
                return view('FrontEnd.chat', ['user_id'=> User::whereRoleIs('user')->first()->id]);
            } else {

                event(new StatusEvent(auth()->user()));

                return view('FrontEnd.chat', ['user_id'=> User::whereRoleIs('seller')->first()->id]);
            }

        }

    }

    public function sendMessage(Request $request, $id) {
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
        if($data['images'] && $user) {
            $message = Message::create([
                'message' => 'images only',
                'm_to'    => $user->id,
                'm_from'  => auth()->user()->id,
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
