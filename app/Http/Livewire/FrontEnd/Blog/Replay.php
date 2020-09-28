<?php

namespace App\Http\Livewire\FrontEnd\Blog;

use Livewire\Component;
use Auth;
use App\Post;
class Replay extends Component
{
    public $blog, $comment, $email, $name, $comment_id, $faxonly;

    public function mount($blog) {
        $this->blog  = $blog;

        if (Auth::check()) {
            $this->name  = auth()->user()->name;
            $this->email = auth()->user()->email;
        }
    }

    public function render()
    {

        return view('livewire.front-end.blog.replay', ['blog' => $this->blog]);
    }

    public function replay()
    {
        if ($this->faxonly) {
            return $this->formResponse();
        }
        $data = $this->validate([
            'name'       => 'required|string|min:1',
            'email'      => 'required|email',
            'comment'    => 'required|string|min:4|max:1000',
            'comment_id' => 'sometimes|nullable|numeric',
        ], [], [
            'name'       => trans('admin.name'),
            'email'      => trans('admin.email'),
            'comment'    => trans('user.comment'),
            'comment_id' => trans('user.comment_id'),
        ]);
            $this->blog->comments()->create([
                'user_id'    => (Auth::check())?auth()->user()->id:NULL,
                'name'       => $data['name'],
                'email'      => $data['email'],
                'comment'    => $data['comment'],
                'comment_id' => $data['comment_id']
            ]);
            $this->comment    = '';
            $this->comment_id = NULL;

    }

    protected function formResponse()
    {
        return redirect()->route('home');
           // ->withSuccess(trans('user.Your_form_has_been_submitted'));
    }
}
