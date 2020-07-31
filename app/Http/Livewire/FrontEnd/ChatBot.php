<?php

namespace App\Http\Livewire\FrontEnd;

use App\Events\SendMesseges;
use App\Events\StatusEvent;
use App\Message;
use Livewire\Component;

class ChatBot extends Component
{
    public $message = '';
    public $user_id;
    public $status;
    public $contacts = [];
    public $paginate_var = 15;
    // Special Syntax: ['echo:{channel},{event}' => '{method}']

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        \App\Message::query()->where('m_to', auth()->user()->id)->update(['is_read' => 1]);
    }

    public function sendMesseges()
    {
        $data = $this->validate([
            'message' => 'required|string|min:1|max:255',
        ], [], [
            'message' => trans('user.message'),
        ]);
        $message = Message::create([
            'message' => $data['message'],
            'm_to' => intval($this->user_id),
            'm_from' => auth()->user()->id,
        ]);

        if (auth()->user()->hasRole('seller')) {
            broadcast(new SendMesseges($message, auth()->user()->id, $this->user_id))->toOthers();
        } else {
            broadcast(new SendMesseges($message, $this->user_id, auth()->user()->id))->toOthers();
        }

    }

    public function render()
    {
        // auth message
        /* $auth_count = $auth_message   = auth()->user()->messages->where('m_to', $this->user_id)->count();
        $auth_message   = auth()->user()->messages->where('m_to', $this->user_id)->skip($auth_count - $this->paginate_var)
        ->take($this->paginate_var);

        // anther user message
        $seller_count = \App\User::find($this->user_id)->messages->where('m_to', auth()->user()->id)->count();
        $seller_message = \App\User::find($this->user_id)->messages->where('m_to', auth()->user()->id)
        ->skip($seller_count - $this->paginate_var)
        ->take($this->paginate_var);

        // check
        if($auth_message->isEmpty()) {
        $messeges = $seller_message;
        } elseif($seller_message->isEmpty()) {
        $messeges = $auth_message;
        }else {
        $messeges = $auth_message->merge($seller_message)->sortBy('id');
        } */
        $auth_id = auth()->user()->id;
        $messages_count = Message::where('m_from', $auth_id)
            ->where('m_to', $this->user_id)
            ->orWhere('m_from', $this->user_id)
            ->where('m_to', $auth_id)
            ->count();

        $messages = Message::where('m_from', $auth_id)
            ->where('m_to', $this->user_id)
            ->orWhere('m_from', $this->user_id)
            ->where('m_to', $auth_id)
            ->skip($messages_count - $this->paginate_var)
            ->take($this->paginate_var)
            ->get();

        //  dd($messages);
        $contacts_message = Message::where('m_to', auth()->user()->id)->orWhere('m_from', auth()->user()->id)
            ->select('m_from', 'm_to')
            ->groupBy('m_from', 'm_to')
            ->get();

        foreach ($contacts_message as $messege) {
            if ($messege->m_to !== auth()->user()->id) {
                if (!in_array($messege->m_to, $this->contacts)) {
                    array_push($this->contacts, $messege->m_to);
                }
            } else {
                if (!in_array($messege->m_from, $this->contacts)) {
                    array_push($this->contacts, $messege->m_from);
                }

            }

        }
        //dd($this->user_id);
        $this->messege = '';
        return view('livewire.front-end.chat-bot', ['messeges' => $messages,'messages_count' => $messages_count]);
    }

    public function ChangeContact($id)
    {
        //dd('asdf');
        $user_id = \App\User::findOrFail($id);
        if ($user_id) {
            $this->user_id = $user_id->id;
        }
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
        broadcast(new StatusEvent(auth()->user()->chat_status, auth()->user()))->toOthers();

    }

    public function readMessage($id)
    {

        Message::where('id', $id)->where('is_read', 0)->first()->update(['is_read' => 1]);

    }

    public function loadMore()
    {
        $this->paginate_var = $this->paginate_var + 15;
    }
}
