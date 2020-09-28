<?php

namespace App\Http\Livewire\Products;

use Illuminate\Http\Request;
use Livewire\Component;

class AddReviews extends Component
{

    public $product,$name, $email,$comment, $review, $faxonly = false;

    public function mount($product)
    {
        $this->product = $product;

        if (\Auth::check()) {
            $this->name = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
    }

    public function render()
    {
        return view('livewire.products.add-reviews', ['product' => $this->product]);
    }

    public function addReview()
    {
        if ($this->faxonly) {
            return $this->formResponse();
        }
        $data = $this->validate([
            'review'  => 'required|numeric|min:1|max:5',
            'name'    => 'required|string|min:1',
            'email'   => 'required|email',
            'comment' => 'required|string|min:8|max:255',
        ], [], [
            'review'  => trans('user.review'),
            'name'    => trans('admin.name'),
            'email'   => trans('admin.email'),
            'comment' => trans('user.comment'),
        ]);
        if (\Auth::check()) {

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
    protected function formResponse()
    {
        return redirect()->route('home');
           // ->withSuccess(trans('user.Your_form_has_been_submitted'));
    }
}
