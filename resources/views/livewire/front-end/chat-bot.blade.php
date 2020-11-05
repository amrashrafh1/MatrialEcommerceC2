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
                            <p>@lang('user.Away')</p>
                        </li>
                        <li id="status-busy" class="chat_status "><span class="status-circle"></span>
                            <p>@lang('user.Busy')</p>
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
                $cont           = \App\Conversation::find($contact);
                $user_id        = ($cont->user_1 != auth()->user()->id)?$cont->user_1:$cont->user_2;
                $user           = \App\User::where('id', $user_id)->first();
                $messages_count = $conv->messages->where('m_from', '!=', auth()->user()->id)->where('is_read',
                '0')->count();
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
                            @if($messages_count)
                                <p style='position: absolute;
                                background: red;
                                padding: 7px;
                                top: 0;
                                right: 0;
                                border-radius: 40%;'>{{$messages_count}}</p>
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
            <span class='connected'
                style='margin-left:30%; color:#3ca73c; overflow:{{$conv_user->chat_status == 'online'?'visible':'hidden'}};'>@lang('user.'.$conv_user->chat_status)</span>
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
                <li class="replies">
                    <img src="{{Storage::url(auth()->user()->image)}}" alt="" />
                    <p style="overflow-wrap: break-word;" id='imageContainer'>
                        @if(count($message->gallery) > 0)
                        @foreach($message->gallery as $file)
                        <img src="{{Storage::url($file->file)}}" alt="" class='image' />
                        @endforeach
                        @else
                        {{$message->message}}
                        @endif
                        <br /> <span
                            style="font-size:12px; float:right;">{{ \Carbon\Carbon::parse($message->created_at)->diffForhumans() }}</span>
                        @if($message->is_read)
                        <br />
                        <span style=' float:right'><i class="fa fa-check-circle" aria-hidden="true"></i>
                        </span>
                        @endif
                    </p>
                </li>
                @else
                <li class="replies">
                    <img src="{{Storage::url(auth()->user()->image)}}" alt="" />
                    <p style="overflow-wrap: break-word;">
                        <a href='{{route('show_product', $message->product->slug)}}'>
                            <img src='{{Storage::url($message->product->image)}}' class='image'>
                            <br />
                            <span style='font-size:16px; color:black'>{{$message->product->name}}</span>
                        </a>
                        <br />
                        <span style="font-size:12px; float:right;
                            padding: 5px;
                            border-radius: 10%;"
                            wire:poll.120000ms>{{ \Carbon\Carbon::parse($message->created_at)->diffForhumans() }}</span>
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
                        @endif <br /> <span style="font-size:12px;float:right;"
                            wire:poll.60000ms>{{ \Carbon\Carbon::parse($message->created_at)->diffForhumans() }}</span>
                    </p>
                </li>
                @else
                <li class="sent">
                    <img src="{{Storage::url($conv_user->image)}}" alt="" />
                    <p style="overflow-wrap: break-word; background:none"><a
                            href='{{route('show_product', $message->product->slug)}}'>
                            <img src='{{Storage::url($message->product->image)}}' style='height:200px; width:200px;
                            border-radius:10%; margin-bottom:15px;
                                '>
                            <br />
                            <span style='font-size:16px; color:black'>{{$message->product->name}}</span>
                        </a><br /> <span style="font-size:12px; float:right;
                            padding: 5px;
                            border-radius: 10%;"
                            wire:poll.60000ms>{{ \Carbon\Carbon::parse($message->created_at)->diffForhumans() }}</span>
                    </p>
                </li>
                @endif
                @endif
                @endforeach
            </ul>
        </div>
        <div class="message-input">
            <div class="wrap">
                <form wire:submit.prevent='sendMesseges' class='submit_form' enctype="multipart/form-data">
                    <input type="text" name='message' autocomplete='off' wire:model.lazy='message'
                        placeholder="@lang('user.Write_your_message...')" id='message' style='width:80%;' />
                    <input type="file" id="image-upload" name="image_upload[]" style='display:none'
                        enctype="multipart/form-data" multiple>
                    <div class="form-group" style="display: none;">
                        <label for="faxonly">Fax Only
                            <input type="checkbox" name="faxonly" id="faxonly" wire:model.lazy='faxonly'/>
                        </label>
                    </div>
                    <i class="fa fa-paperclip attachment" aria-hidden="true" style='margin-right: 35px;'
                        onclick='document.getElementById("image-upload").click();'></i>
                    <button class="submit" style='margin-right: 15px;' type="submit"><i class="fa fa-paper-plane"
                            aria-hidden="true"></i>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

@push('js')
<script src='{{url('/')}}/js/app.js'></script>
<script>
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
            '<br /> <span style="font-size:12px; float:right;"></span></p></li>').appendTo($('.messages ul'));
        $('.message-input input').val(null);
        $('.contact.active .preview').html('<span>You: </span>' + message);
        $(".messages").animate({
            scrollTop: $(document).height() + 10000000
        }, "fast");
    };

    $('.submit').click(function () {
        newMessage();
    });
    Echo.join(`chat.{{$this->conv->id}}`)
        .here((user) => {})
        .joining((user) => {

            @this.call('changeStatus', 'online');
            $('.connected').show();
            $('.contact{{$this->conv->id}} .contact-status').addClass('online');
            $('.contact{{$this->conv->id}} .contact-status').removeClass('away');
            $('.contact{{$this->conv->id}} .contact-status').removeClass('offline');
            $('.contact{{$this->conv->id}} .contact-status').removeClass('busy');
        })
        .leaving((user) => {
            $('.connected').hide();
            @this.call('changeStatus', 'offline');
            $('.contact{{$this->conv->id}} .contact-status').removeClass('online');
            $('.contact{{$this->conv->id}} .contact-status').removeClass('away');
            $('.contact{{$this->conv->id}} .contact-status').removeClass('busy');
            $('.contact{{$this->conv->id}} .contact-status').addClass('offline');

        })
        .listen('SendMesseges', (e) => {

            @this.call('readMessage', e.message.id);

            message = e.message.message;
            if ($.trim(message) == '') {
                return false;
            }

            $('<li class="sent"><img src="{{Storage::url($conv_user->image)}}" alt="" /><p>' +
                message +
                '<br /> <span style="font-size:12px;float:right;"></span></p></li>').appendTo($('.messages ul'));
            $('.message-input input').val(null);
            $('.contact.active .preview').html('<span>You: </span>' + message);
            $(".messages").animate({
                scrollTop: $(document).height() + 10000000
            }, "fast");
        });



    $('#contacts').on('click', 'li', function () {
        $('#contacts li.active').removeClass('active');
        $(this).addClass('active');
    });
    $('#messages').scroll(function () {
        var top = $('#messages').scrollTop();
        if (top == 0) {
            @this.call('loadMore');
        }
    });
    $(document).ready(function () {
        $('.chat_status').on('click', function (e) {
            localStorage.setItem('chat_status', $(this).attr('id').replace('status-', ''));
            @this.call('changeStatus');
        });
        var chat_status = localStorage.getItem('chat_status');
        if (chat_status) {
            $('#status-' + chat_status).addClass('active');
            $('#status-' + chat_status).siblings().removeClass('active');
        }
    });

    /*  change status event  */
    Echo.private(`status`)
        .listen('StatusEvent', (e) => {
            $('.contact' + e.data['user_id'] + ' .contact-status').removeClass('online');
            $('.contact' + e.data['user_id'] + ' .contact-status').removeClass('away');
            $('.contact' + e.data['user_id'] + ' .contact-status').removeClass('offline');
            $('.contact' + e.data['user_id'] + ' .contact-status').removeClass('busy');
            $('.contact' + e.data['user_id'] + ' .contact-status').addClass(e.data['status']);
            //console.log(e.data['status']);
        });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#image-upload').change(function () {
        event.preventDefault();
        let image_upload = new FormData();
        let TotalImages = $('#image-upload')[0].files.length; //Total Images
        let images = $('#image-upload')[0];
        //let message = $('#message').val();

        for (let i = 0; i < TotalImages; i++) {
            image_upload.append('images[]', images.files[i]);
        }
        // image_upload.append('message', message);

        $.ajax({
            method: 'POST',
            url: '{{route("sendMessage", $this->conv->id)}}',
            data: image_upload,
            contentType: false,
            processData: false,
            success: function (images) {

                /* if ($.trim(images) == '') {
                    return false;
                }
                var i;
                for (i = 0; i < images.length; ++i) {
                console.log(images[i]);
                $('<li class="replies"><p style="overflow-wrap: break-word; margin-right:25px;" id="imageContainer"><img src="'+images[i]+'" class="image" alt="" />'+
                    '<br /> <span style="font-size:12px; float:right;"></span></p></li>').appendTo($('.messages ul'));
                $('.message-input input').val(null);
                $(".messages").animate({
                    scrollTop: $(document).height() + 10000000
                }, "fast");
                } */

                window.livewire.emit('chatUpdated');
            },
            error: function () {
                console.log(`Failed`)
            }
        })

    });


    // function for time
    /* function get_time() {
        t = new Date().getSeconds();
        if(t > 86400) {
        return Math.floor(t / 86400) + ' days ago';
        } else if(t > 3600) {
            return Math.floor(t / 3600) + ' hours ago';
        } else if(t > 60) {
            return Math.floor(t / 60) + ' minutes ago';
        } else {
            return t + ' seconds ago';
        }
    } */

    $('#imageContainer img').each(function (index) {
        if ($(this).attr('onclick') != null) {
            if ($(this).attr('onclick').indexOf("runThis()") == -1) {
                $(this).click(function () {
                    $(this).attr('onclick');
                    var src = $(this).attr("src");
                    ShowLargeImage(src);
                });
            }
        } else {
            $(this).click(function () {
                var src = $(this).attr("src");
                ShowLargeImage(src);
            });
        }
    });

    $('body').on('click', '.modal-overlay', function () {
        $('.modal-overlay, .modal-img').remove();
    });

    function ShowLargeImage(imagePath) {
        console.log('zoomed');
        $('body').append('<div class="modal-overlay"></div><div class="modal-img"><img src="' + imagePath.replace(
            "small", "large") + '" /></div>');
    }

    /* window.livewire.on('scroll', function()  {
          $('#messages').animate({
              scrollTop: $('#messages')[0].scrollHeight}, "slow");
    }) */

</script>
@endpush
