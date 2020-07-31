<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\StatusEvent;
class ChatController extends Controller
{
    public function seller($slug) {
        if(auth()->user()->hasRole('seller')) {
            $user_id = \App\User::where('id', $slug)->first();
            if($user_id) {
                event(new StatusEvent(auth()->user()));
                return view('FrontEnd.chat', ['user_id'=> $user_id->id]);
            } else {
                return redirect()->route('home');
            }
    } else {
        $product = \App\Product::where('slug', $slug)->first();
        if($product) {
            if(url()->previous() === route('show_product', $slug)) {
                auth()->user()->messages()->create([
                    'message' => 'product',
                    'product_id' => $product->id,
                    'm_to'    => intval($product->seller->id),
                    'm_from'  => auth()->user()->id,
                ]);
                return $this->customer($slug);
            } else {

                return $this->customer($slug);
            }
        } else {
            return redirect()->route('home');
        }
    }
    }

    public function customer ($slug) {
        $user_id = \App\Product::where('slug', $slug)->first();
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
                return view('FrontEnd.chat', ['user_id'=> \App\User::whereRoleIs('user')->first()->id]);
            } else {

                event(new StatusEvent(auth()->user()));

                return view('FrontEnd.chat', ['user_id'=> \App\User::whereRoleIs('seller')->first()->id]);
            }

        }

    }
}
