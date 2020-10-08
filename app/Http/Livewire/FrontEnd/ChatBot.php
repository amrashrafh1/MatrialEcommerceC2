<?php

namespace App\Http\Livewire\FrontEnd;

use App\Conversation;
use App\Events\SendMesseges;
use App\Events\StatusEvent;
use App\Message;
use App\User;
use Livewire\Component;

class ChatBot extends Component
{

    public $message, $conv,$conv_id,$faxonly, $status,$contacts = [], $paginate_var = 15, $user_id,$chat_update = false;

    public function chatUpdated()
    {
        $this->chat_update = true;
    }

    public function mount(Conversation $conv)
    {
        $this->conv    = $conv;
        $this->conv_id = $conv->id;
        $this->user_id = ($conv->user_1 != auth()->user()->id)?$conv->user_1:$conv->user_2;
    }

    public function sendMesseges()
    {
        if(empty(trim($this->message))){
            return;
        }
        if ($this->faxonly) {
            return $this->formResponse();
        }
        $data = $this->validate([
            'message' => 'required|string|min:1|max:255',
        ]);
        $message = $this->conv->messages()->create([
            'message' => $data['message'],
            'm_to'    => $this->user_id,
            'm_from'  => auth()->user()->id,
        ]);
        $this->message = '';

        return broadcast(new SendMesseges($message, $this->conv_id))->toOthers();

    }

    public function render()
    {
        // messages
        $conversation = $this->conv;
        if ($conversation) {
            // get user->id
            $auth_id = auth()->user()->id;

            // update is read
            $conversation->messages()->where('m_to', $auth_id)->update(['is_read'=> 1]);

            // get messages count for
            $messages_count = $conversation->messages->count();
            $messages = $conversation->messages()
            ->skip($messages_count - $this->paginate_var)
            ->take($this->paginate_var)
            ->get();

            $contacts_message = Conversation::where('user_1', $auth_id)->orWhere('user_2', $auth_id)->get();

            foreach ($contacts_message as $conv) {
                if (!in_array($conv->id, $this->contacts)) {
                    array_push($this->contacts, $conv->id);
                }
            }
        }
        $conv_user = User::find($this->user_id);
        $this->messege = '';
        return view('livewire.front-end.chat-bot', ['messeges' => $messages, 'messages_count' => $messages_count
        ,'conv_user' => $conv_user]);
    }


    public function updatedStatus()
    {
        // dd($this->status);
        $user = auth()->user();
        if ($this->status === 'online') {
            $user->chat_status = 'online';
            $user->save();
        } elseif ($this->status === 'offline') {
            $user->chat_status = 'offline';
            $user->save();
        } elseif ($this->status === 'away') {
            $user->chat_status = 'away';
            $user->save();
        } elseif ($this->status === 'busy') {
            $user->chat_status = 'busy';
            $user->save();
        }
        $this->changeStatus();
    }

    public function readMessage($id)
    {

        Message::where('id', $id)->where('is_read', 0)->first()->update(['is_read' => 1]);

    }

    public function loadMore()
    {
        $this->paginate_var = $this->paginate_var + 15;
    }

    public function changeStatus($status = null)
    {

        if ($status) {
            $user = User::where('id', $this->user_id)->first();
            if ($user) {
                // dd('asd');
                return broadcast(new StatusEvent($user, $status))->toOthers();
            }
        }
        return broadcast(new StatusEvent(auth()->user()))->toOthers();

    }

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }

    protected function formResponse()
    {
        return redirect()->route('home');
           // ->withSuccess(trans('user.Your_form_has_been_submitted'));
    }
}
