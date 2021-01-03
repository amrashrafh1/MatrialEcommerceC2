<div id="frame">
    <div id="sidepanel">
        <div id="profile" wire:ignore>
            <div class="wrap">
                <img id="profile-img"
                    src="{{(auth()->user()->image)? Storage::url(auth()->user()->image) :url('/img/avatar.jpg')}}"
                    class="
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
                        <li id="status-online" class="chat_status active"><span class="status-circle"></span>
                            <p>@lang('user.online')</p>
                        </li>
                        <li id="status-away" class="chat_status "><span class="status-circle"></span>
                            <p>@lang('user.away')</p>
                        </li>
                        <li id="status-busy" class="chat_status "><span class="status-circle"></span>
                            <p>@lang('user.busy')</p>
                        </li>
                        <li id="status-offline" class="chat_status ">
                            <span class="status-circle"></span>
                            <p>@lang('user.Offline')</p>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div id="contacts" wire:ignore>
            <ul>
                @foreach($this->contacts as $contact)
                @php
                $cont                = \App\Conversation::find($contact);
                $user_id             = ($cont->user_1 != auth()->user()->id)?$cont->user_1:$cont->user_2;
                $user                = \App\User::where('id', $user_id)->first();
                $auth_messages_count = $conv->messages()->where('m_to', auth()->user()->id)->where('is_read',
                0)->count();
                @endphp
                <li class="contact contact{{$cont->id}} {{($cont->id === $this->conv->id)?'active':''}}">
                    <a href='
                        {{route('show_chat', [
                        'memberTypeTo'   => 'member',
                        'seq'            => Crypt::encrypt($user_id),
                        ])}}' style='color:#fff;'>
                        <div class="wrap">
                            <span class="contact-status {{$user->chat_status}}"></span>
                            <img src="{{$user->image?Storage::url($user->image):url('/img/avatar.jpg')}}" alt="" />
                            <div class="meta">
                                <p class="name">{{$user->name}}</p>
                                <p class="preview">
                                    @php
                                    $mess = $user->messages->where('m_to', auth()->user()->id)->last();
                                    @endphp
                                    {{($mess)?(count($mess->gallery) > 0)?'':'':''}}</p>
                            </div>
                            @if($auth_messages_count)
                                <p style='position: absolute;
                                background: red;
                                padding: 5px;
                                top: 0;
                                right: 0;
                                border-radius: 40%;'>{{$auth_messages_count}}</p>
                            @endif
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="contact-profile" wire:ignore>
            <img src="{{Storage::url($conv_user->image)}}" alt="" />
            <p>{{$conv_user->name}}</p>
            <span class='connected' id='connected'
                style='margin-left:30%;'>@lang('user.'.$conv_user->chat_status)</span>
        </div>
        @if($messages_count > $this->paginate_var)
        <div class='position-relative p-3'>
            <button class='btn btn-primary-outline' wire:click='loadMore' style='width: 100%;
            top: 0;
            position: absolute;
            left: 0;'><i class='fa fa-spinner'></i> @lang('user.Load_more')</button>
        </div>
        @endif
        <div id='messages' class="messages" style='padding-bottom:30px;'>
            <ul>
                @foreach($messeges as $message)
                @if($message->m_from === auth()->user()->id)
                @if(empty($message->product_id))
                <li class="replies {{$message->id}}">
                    <img src="{{Storage::url(auth()->user()->image)}}" alt="" />
                    <p style="overflow-wrap: break-word;" id='imageContainer'>
                        @if(count($message->gallery) > 0)
                        @foreach($message->gallery as $file)
                        <img src="{{Storage::url($file->file)}}" alt="" class='image' />
                        @endforeach
                        @else
                        {{$message->message}}
                        @endif
                        <br /> <span class="timeCounter"
                            style="font-size:12px; float:right;" data-time="{{ \Carbon\Carbon::parse($message->created_at)->toIso8601String() }}"></span>
                        @if($message->is_read)
                        <br />
                        <span style=' float:right'><i class="fa fa-check-circle" aria-hidden="true"></i>
                        </span>
                        @endif
                    </p>
                </li>
                @else
                <li class="replies {{$message->id}}">
                    <img src="{{Storage::url(auth()->user()->image)}}" alt="" />
                    <p style="overflow-wrap: break-word;"><a
                        href='{{route('show_product', $message->product->slug)}}' target="_blank">
                        <img src='{{Storage::url($message->product->image)}}' style='height:200px; width:200px;
                        border-radius:10%; margin-bottom:15px;
                            '>
                        <br />
                            <span style='font-size:16px; color:black'>{{$message->product->name}}</span>
                        </a>
                        <br />
                        <span class="timeCounter" style="font-size:12px; float:right;
                        padding: 5px;
                        border-radius: 10%;" data-time="{{ \Carbon\Carbon::parse($message->created_at)->toIso8601String() }}" ></span>
                        @if($message->is_read)
                        <br />
                        <span style=' float:right'><i class="fa fa-check-circle" aria-hidden="true"></i>
                        </span>
                        @endif
                    </p>
                </li>
                @endif
                @else
                @if(empty($message->product_id))
                <li class="sent">
                    <img src="{{Storage::url($conv_user->image)}}" alt="" />
                    <p style="overflow-wrap: break-word;" id='imageContainer'>
                        @if(count($message->gallery) > 0)
                        @foreach($message->gallery as $file)
                        <img src="{{Storage::url($file->file)}}" alt="" class='image' wire:ignore />
                        @endforeach
                        @else
                        {{$message->message}}
                        @endif <br /> <span class="timeCounter" style="font-size:12px;float:right;" data-time="{{ \Carbon\Carbon::parse($message->created_at)->toIso8601String() }}"></span>
                    </p>
                </li>
                @else
                <li class="sent">
                    <img src="{{Storage::url($conv_user->image)}}" alt="" />
                    <p style="overflow-wrap: break-word;"><a
                            href='{{route('show_product', $message->product->slug)}}' target="_blank">
                            <img src='{{Storage::url($message->product->image)}}' style='height:200px; width:200px;
                            border-radius:10%; margin-bottom:15px;
                                '>
                            <br />
                            <span style='font-size:16px; color:#fff'>{{$message->product->name}}</span>
                        </a><br /> <span class="timeCounter" style="font-size:12px; float:right;
                            padding: 5px;
                            border-radius: 10%;" data-time="{{ \Carbon\Carbon::parse($message->created_at)->toIso8601String() }}"></span>
                    </p>
                </li>
                @endif
                @endif
                @endforeach
                <li class="sent typing" style='display:none;'><img src="{{Storage::url($conv_user->image)}}" alt="" /><div style="background: #435f7a;color: #f5f5f5; overflow-wrap: break-word;    display: inline-block;
                    padding: 25px 30px;border-radius: 20px;max-width: 205px;line-height: 130%;">
                <div class="col-12"><div class="snippet" data-title=".dot-falling"><div class="stage"><div class="dot-falling"></div>
                 </div></div></div></div></li>
                 <div id="loading" wire:loading>
                    <div class="loader"></div>
                </div>
            </ul>
        </div>
        <div class="message-input">
            <div class="wrap">
                <form class='submit_form' enctype="multipart/form-data">
                    <input type="text" name='message' autocomplete='off' class='typefield'
                        placeholder="@lang('user.Write_your_message...')" id='message' style='width:80%;' />
                    <input type="file" id="image-upload" name="image_upload[]" style='display:none'
                        enctype="multipart/form-data" multiple>
                    <div class="form-group" style="display: none;">
                        <label for="faxonly">Fax Only
                            <input type="text" name="faxonly" id="faxonly"/>
                        </label>
                    </div>
                    <i class="fa fa-paperclip attachment" aria-hidden="true" style='margin-right: 35px;'
                        onclick='document.getElementById("image-upload").click();'></i>
                    <button class="submit" style='margin-right: 15px;' type="submit"><i class="fa fa-paper-plane"
                            aria-hidden="true"></i>
                    </button>
                </form>

            </div>
            <input type='hidden' wire:model='paginate_var' id='paginate_var'>
        </div>
    </div>
</div>

@push('js')
<script src='{{url('/')}}/js/app.js'></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#messages').animate({
       scrollTop: $('#messages')[0].scrollHeight}, "slow");

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
    let channel = Echo.join(`chat.{{$this->conv_id}}`)

    function newMessage() {

        message = $(".message-input #message").val();
        if ($.trim(message) == '') {
            return false;
        }
        $now = Date.now();
        event.preventDefault();
        var faxonly      = $('#faxonly').val();

        $.ajax({
            method: 'POST',
            url: '{{route("sendMessage", $this->conv->id)}}',
            dataType: "json",
            data: {message: message, faxonly:faxonly},
            success: function (message) {
                $('<li class="replies  ' + message.id + '"><img src="{{Storage::url(auth()->user()->image)}}" alt="" /><p>' +
                    message.message +
                    '<br /> <span class="timeCounter" style="font-size:12px;float:right;" data-time="'+ $now +'"></span></p></li>').appendTo($('.messages ul'));
                $('.message-input #message').val(null);
                setTimeout( () => {
                    channel.whisper('typing', {
                        typing : false
                    })
                }, 300)
                $('.contact.active .preview').html('<span>You: </span>' + message.message);
                $('#messages').animate({
                scrollTop: $('#messages')[0].scrollHeight}, "fast");
            },
            error: function () {
                $('<li class="replies"><p class="text-danger"><i class="fa fa-exclamation-circle"></i> {{trans("user.failed_to_send_message")}}</p></li>').appendTo($('.messages ul'));
                $('.message-input #message').val(null);
                $('#messages').animate({
       scrollTop: $('#messages')[0].scrollHeight}, "slow");
            }
        })
    };

    $('.message-input #message').keydown(function() {
    if(!$(this).val()) {
        setTimeout( () => {
            channel.whisper('typing', {
                typing : false
            })
        }, 300)
    } else {

        setTimeout( () => {
            channel.whisper('typing', {
                typing : true
            })
        }, 300)
    }
    });
    $('.message-input #message').keyup(function() {
        if(!$(this).val()) {
            setTimeout( () => {
                channel.whisper('typing', {
                    typing : false
                })
            }, 300)
        }
    });

    $('.submit').click(function () {
        newMessage();
    });
    channel.here((user) => {
        var index = user[0]['email'] == '{{auth()->user()->email}}' ? 1 : 0;
            $('#connected').removeClass().addClass(user[index]['chat_status']).text(user[index]['chat_status']);
            $('.contact{{$this->conv_id}}').find('span').removeClass().addClass(user[index]['chat_status']);
        })
        .joining((user) => {
            $('#connected').removeClass().addClass(user['chat_status']).text(user['chat_status']);
            $('.contact{{$this->conv_id}}').find('span').removeClass().addClass(user['chat_status']);

        }).listenForWhisper('typing', (e) => {
            e.typing ? '' : $('.typing').appendTo($('.messages ul'));
            e.typing ? $('.typing').fadeIn() : $('.typing').fadeOut()
            $(".messages").animate({
                    scrollTop: $(document).height() + 10000000
            }, "fast");
        })
        .leaving((user) => {
            $('#connected').removeClass().addClass('offline').text("@lang('user.Offline')");
            $('.contact{{$this->conv_id}}').find('span').removeClass().addClass('offline');
        })
        .listen('SendMesseges', (e) => {

            message = e.message.message;
            if ($.trim(message) == '') {
                return false;
            }
            var sound_notification = $("#chat_sound")[0];
            sound_notification.play();

            $now = Date.now();

            $('.typing').fadeOut();

        if(e.gallery.length > 0) {
            uploadedSuccess(e.gallery, false);
        } else {
            $('<li class="sent"><img src="{{Storage::url($conv_user->image)}}" alt="" /><p>' +
                message +
                '<br /> <span class="timeCounter" style="font-size:12px;float:right;" data-time="'+ $now +'"></span></span></p></li>').appendTo($('.messages ul'));
            $('.message-input input').val(null);
            $('.contact.active .preview').html('<span>You: </span>' + message);
        }
        var faxonly      = $('#faxonly').val();

        $.ajax({
            method: 'POST',
            url: '{{url("/chat/message/isreaded/")}}/'+ e.message.id,
            dataType: "json",
            data: {is_readed:1, faxonly:faxonly},
        });
        $('#messages').animate({
            scrollTop: $('#messages')[0].scrollHeight}, "slow");
        });

    $('#contacts').on('click', 'li', function () {
        $('#contacts li.active').removeClass('active');
        $(this).addClass('active');
    });
    $('#messages').scroll(function () {
        var top    = $(this).scrollTop();
        if (top == 0) {
            @this.call('loadMore');
            $paginate_var = $('#paginate_var').val();
            $('#messages').scrollTop($('#messages')[0].scrollHeight *  (15 / $paginate_var))
        }
    });

    /*  change status event  */
    Echo.private(`status`)
        .listen('StatusEvent', (e) => {
        $('.contact' + e.data['conv_id']).find('span').removeClass().addClass(e.data['status'])
        $('#connected').removeClass().addClass(e.data['status']).text(e.data['statusText']);
    });

    Echo.private(`is-readed`)
        .listen('IsReaded', (e) => {
        $('#messages ul li.' + e['message_id'] + ' p').append("<br /><span style=' float:right'><i class='fa fa-check-circle' aria-hidden='true'></i></span>");
        $('#messages').animate({
            scrollTop: $('#messages')[0].scrollHeight}, "fast");
    });

    $('#image-upload').change(function () {
        event.preventDefault();
        let image_upload = new FormData();
        let TotalImages  = $('#image-upload')[0].files.length;  //Total Images
        let images       = $('#image-upload')[0];

        for (let i = 0; i < TotalImages; i++) {
            image_upload.append('images[]', images.files[i]);
        }
       // var faxonly      = $('#faxonly').val();

        $.ajax({
            method: 'POST',
            url: '{{route("sendImages", $this->conv->id)}}',
            data: image_upload,
            contentType: false,
            processData: false,
            success: function (images) {
                uploadedSuccess(images['images']);
                $('#messages').animate({
                    scrollTop: $('#messages')[0].scrollHeight}, "slow");
            },
            error: function () {
                $('<li class="replies"><p class="text-danger"><i class="fa fa-exclamation-circle"></i> {{trans("user.failed_to_send_image")}}</p></li>').appendTo($('.messages ul'));
                $('.message-input #message').val(null);
                $('#messages').animate({
       scrollTop: $('#messages')[0].scrollHeight}, "slow");
            }
        })

    });

</script>
@endpush
