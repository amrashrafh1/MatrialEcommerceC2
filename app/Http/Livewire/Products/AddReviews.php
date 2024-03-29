<?php

namespace App\Http\Livewire\Products;

use Illuminate\Http\Request;
use Livewire\Component;

class AddReviews extends Component
{

    public $item,$name, $email,$comment, $review,$message, $faxonly = false;

    public function mount($item)
    {
        $this->item = $item;

        if (\Auth::check()) {
            $this->name  = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
    }

    public function render()
    {
        return view('livewire.products.add-reviews', ['item' => $this->item]);
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

                $rating = $this->item->rating([
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
                $this->review  = 0;
                $this->message = trans('user.Thank_you_for_your_review');

        }
    }
    protected function formResponse()
    {
        return redirect()->route('home');
           // ->withSuccess(trans('user.Your_form_has_been_submitted'));
    }

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
