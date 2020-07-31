<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Illuminate\Http\Request;

class AddReviews extends Component
{

    public $product;
    public $name;
    public $email;
    public $comment;
    public $review;


    public function mount($product) {
        $this->product = $product;

        if(\Auth::check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
    }

    public function render()
    {
        return view('livewire.products.add-reviews', ['product' =>$this->product]);
    }



    public function addReview(Request $request) {

        $data = $this->validate([
            'review'  => 'required|numeric|min:1|max:5',
            'name'    => 'required|string|min:1',
            'email'   => 'required|email',
            'comment' => 'required|string|min:8|max:255',
        ], [], [
            'review'  => trans('user.review'),
            'name'    => trans('admin.name'),
            'email'   => trans('admin.email'),
            'comment' => trans('user.review'),
        ]);
        if(\Auth::check()) {
            $rating = $this->product->rating([
                'title'                   => $data['name'],
                'body'                    => $data['comment'],
                'customer_service_rating' => $data['review'],
                'quality_rating'          => $data['review'],
                'friendly_rating'         => $data['review'],
                'pricing_rating'          => $data['review'],
                'rating'                  => $data['review'],
                'recommend'               => 'Yes',
                'approved'                => false,
            ], auth()->user());
            $this->comment = '';
            $this->review = 0;
        }
    }
}
