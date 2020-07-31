<div id="frame" wire:ignore.self>
    @php
    $user = \App\User::find($this->user_id);
    @endphp
    <div id="sidepanel">
        <div id="profile" wire:ignore>
            <div class="wrap">
                <img id="profile-img" src="{{Storage::url(auth()->user()->image)}}" class="
                @if(auth()->user()->chat_status === 'online')
                online
                @elseif(auth()->user()->chat_status === 'offline')
                offline
                @elseif(auth()->user()->chat_status === 'away')
                away
                @else
                busy
                @endif
                " alt="" />
                <p>{{auth()->user()->name}}</p>
                <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
                <div id="status-options">
                    <ul>
                        <li id="status-online" class="{{(auth()->user()->chat_status === 'online')?'active':''}}"><span
                                class="status-circle"></span>
                            <p>Online</p>
                        </li>
                        <li id="status-away" class="{{(auth()->user()->chat_status === 'away')?'active':''}}"><span
                                class="status-circle"></span>
                            <p>Away</p>
                        </li>
                        <li id="status-busy" class="{{(auth()->user()->chat_status === 'busy')?'active':''}}"><span
                                class="status-circle"></span>
                            <p>Busy</p>
                        </li>
                        <li id="status-offline" class="{{(auth()->user()->chat_status === 'offline')?'active':''}}">
                            <span class="status-circle"></span>
                            <p>Offline</p>
                        </li>
                    </ul>
                </div>
                <div id="expanded">
                    <label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
                    <input name="twitter" type="text" value="mikeross" />
                    <label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
                    <input name="twitter" type="text" value="ross81" />
                    <label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
                    <input name="twitter" type="text" value="mike.ross" />
                </div>
            </div>
        </div>
        {{-- <div id="search" wire:ignore>
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" placeholder="Search contacts..." />
        </div> --}}
        <div id="contacts" wire:ignore>
            <ul>
                @foreach($this->contacts as $contact)
                @php
                $cont = \App\User::find($contact);
                @endphp
                <li class="contact {{($cont->id === $this->user_id)?'active':''}}"
                    wire:click='ChangeContact({{$cont->id}})'>
                    <div class="wrap">
                        <img src="{{Storage::url($cont->image)}}" alt="" />
                        <div class="meta">
                            <p class="name">{{$cont->name}}</p>
                            <p class="preview">
                                @php
                                $mess = $cont->messages->where('m_to', auth()->user()->id)->last();
                                @endphp
                                {{($mess)?$mess->message:''}}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="content">
        <div class="contact-profile" wire:ignore>
            <img src="{{Storage::url($user->image)}}" alt="" />
            <p>{{$user->name}}</p>
            <div class="social-media">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </div>
        </div>
        @if($messages_count > $this->paginate_var)
        <div class='position-relative p-3'>
            <button class='btn btn-primary-outline' wire:click='loadMore' style='width: 100%;
            top: 0;
            position: absolute;
            left: 0;'><i class='fa fa-spinner'></i> @lang('user.Load_more')</button>
        </div>
        @endif
        <div id='messages' class="messages">
            <ul>
                @foreach($messeges as $message)
                @if($message->m_from === auth()->user()->id)
                @if(empty($message->product_id))
                <li class="replies">
                    <img src="{{Storage::url(auth()->user()->image)}}" alt="" />
                    <p style="overflow-wrap: break-word;">{{$message->message}}
                        <br /> <span
                            style="font-size:12px; float:right;">{{ \Carbon\Carbon::parse($message->created_at)->diffForhumans() }}</span>
                            @if($message->is_read)
                            <br/>
                            <span style=' float:right'><i class="fa fa-check-circle" aria-hidden="true"></i>
                            </span>
                            @endif
                        </p>
                </li>
                @else
                <li class="replies">
                    <img src="{{Storage::url(auth()->user()->image)}}" alt="" />
                    <p style="overflow-wrap: break-word; background:none">
                        <a href='{{route('show_product', $message->product->slug)}}'>
                            <img src='{{Storage::url($message->product->image)}}' style='height:200px; width:200px;
                        border-radius:10%; margin-bottom:15px;
                                '>
                            <br />
                            <span style='font-size:16px; color:black'>{{$message->product->name}}</span>
                        </a>
                        <br />
                        <span
                            style="font-size:12px; float:right;background: #2C3E50;
                            padding: 5px;
                            border-radius: 10%;">{{ \Carbon\Carbon::parse($message->created_at)->diffForhumans() }}</span>
                    @if($message->is_read)
                    <br/>
                    <span style=' float:right'><i class="fa fa-check-circle" aria-hidden="true"></i>
                    </span>
                    @endif
                </p>
                </li>
                @endif
                @else
                @if(empty($message->product_id))
                <li class="sent">
                    <img src="{{Storage::url($user->image)}}" alt="" />
                    <p style="overflow-wrap: break-word;">{{$message->message}} <br /> <span
                            style="font-size:12px;float:right;">{{ \Carbon\Carbon::parse($message->created_at)->diffForhumans() }}</span>
                        </p>
                </li>
                @else
                <li class="sent">
                    <img src="{{Storage::url($user->image)}}" alt="" />
                    <p style="overflow-wrap: break-word; background:none"><a
                            href='{{route('show_product', $message->product->slug)}}'>
                            <img src='{{Storage::url($message->product->image)}}' style='height:200px; width:200px;
                            border-radius:10%; margin-bottom:15px;
                                    '>
                            <br />
                            <span style='font-size:16px; color:black'>{{$message->product->name}}</span>
                        </a><br /> <span
                            style="font-size:12px; float:right;
                            padding: 5px;
                            border-radius: 10%;">{{ \Carbon\Carbon::parse($message->created_at)->diffForhumans() }}</span>
                    </p>
                </li>
                @endif
                @endif
                @endforeach
            </ul>
        </div>
        <div class="message-input" wire:ignore>
            <div class="wrap">
                <form wire:submit.prevent='sendMesseges'>
                    <input type="text" placeholder="Write your message..." wire:model.lazy='message' />
                    {{-- <i class="fa fa-paperclip attachment" aria-hidden="true"></i> --}}
                    <button class="submit" style='margin-right: 15px;' type="submit"><i class="fa fa-paper-plane"
                            aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src='{{url('/')}}/js/app.js'></script>
<script>
    document.addEventListener("livewire:load", function (event) {
        window.livewire.hook('beforeDomUpdate', () => {
            // Add your custom JavaScript here.
        });

        window.livewire.hook('afterDomUpdate', () => {
            $(".messages").animate({
                scrollTop: $(document).height() + 10000000
            }, "fast");
        });
    });
    $(".messages").animate({
        scrollTop: $(document).height() + 10000000
    }, "fast");

    $("#profile-img").click(function () {
        $("#status-options").addClass("active");
    });

    $(".expand-button").click(function () {
        $("#profile").toggleClass("expanded");
        $("#contacts").toggleClass("expanded");
    });

    $("#status-options ul li").click(function () {
        $("#profile-img").removeClass();
        $("#status-online").removeClass("active");
        $("#status-away").removeClass("active");
        $("#status-busy").removeClass("active");
        $("#status-offline").removeClass("active");
        $(this).addClass("active");
        if ($("#status-online").hasClass("active")) {
            $("#profile-img").addClass("online");
            @this.set('status', 'online');
        } else if ($("#status-away").hasClass("active")) {
            $("#profile-img").addClass("away");
            @this.set('status', 'away');
        } else if ($("#status-busy").hasClass("active")) {
            $("#profile-img").addClass("busy");
            @this.set('status', 'busy');
        } else if ($("#status-offline").hasClass("active")) {
            $("#profile-img").addClass("offline");
            @this.set('status', 'offline');
        } else {
            $("#profile-img").removeClass();
        };

        $("#status-options").removeClass("active");
    });

    function newMessage() {
        message = $(".message-input input").val();
        if ($.trim(message) == '') {
            return false;
        }
        $('<li class="replies"><img src="{{Storage::url(auth()->user()->image)}}" alt="" /><p>' +
            message +
            '</p></li>').appendTo($('.messages ul'));
        $('.message-input input').val(null);
        $('.contact.active .preview').html('<span>You: </span>' + message);
        $(".messages").animate({
            scrollTop: $(document).height() + 10000000
        }, "fast");
        $(".message-input input").val('');
    };

    $('.submit').click(function () {
        newMessage();
    });

    @role('seller')

    Echo.join(`chat-{{auth()->user()->id}}-{{$this->user_id}}`)
        .here((user) => {})
        .joining((user) => {})
        .leaving((user) => {})
        .listen('SendMesseges', (e) => {
//            @this.emitSelf('readMessage', e.message.id);
            @this.call('readMessage', e.message.id)

            message = e.message.message;
            if ($.trim(message) == '') {
                return false;
            }
            $('<li class="sent"><img src="{{Storage::url($user->image)}}" alt="" /><p>' +
                message +
                '</p></li>').appendTo($('.messages ul'));
            $('.message-input input').val(null);
            $('.contact.active .preview').html('<span>You: </span>' + message);
            $(".messages").animate({
                scrollTop: $(document).height() + 10000000
            }, "fast");
        });

    @else

    Echo.join(`chat-{{$this->user_id}}-{{auth()->user()->id}}`)
        .here((user) => {})
        .joining((user) => {})
        .leaving((user) => {})
        .listen('SendMesseges', (e) => {

            @this.call('readMessage', e.message.id);

            message = e.message.message;
            if ($.trim(message) == '') {
                return false;
            }
            $('<li class="sent"><img src="{{Storage::url(auth()->user()->image)}}" alt="" /><p>' +
                message +
                '</p></li>').appendTo($('.messages ul'));
            $('.message-input input').val(null);
            $('.contact.active .preview').html('<span>You: </span>' + message);
            $(".messages").animate({
                scrollTop: $(document).height() + 10000000
            }, "fast");
        });
    @endrole

    $('#contacts').on('click', 'li', function () {
        $('#contacts li.active').removeClass('active');
        $(this).addClass('active');
    });
    $('#messages').scroll(function() {
   var top = $('#messages').scrollTop();
       if ( top == 0) {
        @this.call('loadMore');
        }
});
</script>
