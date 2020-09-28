<div id="comments" class="comments-area" style='font-size:15px;'>
    @if($blog->commentable)
    <h2 class="comments-title"> {{($blog->comments)?count($blog->comments):0}} @lang('user.Comment')</h2>
    <ol class="commentlist">
        @foreach($blog->comments->where('comment_id', NULL) as $comment)
        <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1">
            <div class="comment_container">
                <img width="100" height="100" class="avatar avatar-100 photo"
                    src="{{Storage::url($comment->user->image)}}" alt="">
                <div class="comment-text">
                    <div class="meta">
                        <strong class="woocommerce-review__author" itemprop="author" style='font-size:15px;'>{{$comment->user->name}}</strong>
                        <time datetime="{{Carbon\Carbon::parse($blog->created_at)->format('M d Y')}}"
                            class="woocommerce-review__published-date">{{Carbon\Carbon::parse($blog->created_at)->format('M d Y')}}</time>
                    </div>
                    <div class="comment-content" @if(count($comment->comments)) style='border-left: 1px solid; padding-left:17px;' @endif>
                        <div class="description">
                            <p>{{$comment->comment}}</p>
                        </div>
                        <div class="reply">
                            <a href="#respond" class="comment-reply-link" rel="nofollow" wire:click="$set('comment_id', {{$comment->id}})">@lang('user.reply')</a>
                        </div>
                        <!-- .reply -->
                    </div>
                    <!-- .comment-content -->
                </div>
                <!-- .comment-text -->
            </div>
            <ol class="commentlist" style='margin-left: 60px;'>
                @foreach($comment->comments as $com)
                <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1">
                    <div class="comment_container">
                        <img width="100" height="100" class="avatar avatar-100 photo"
                            src="{{Storage::url($com->user->image)}}" alt="">
                        <div class="comment-text">
                            <div class="meta">
                                <strong class="woocommerce-review__author" itemprop="author" style='font-size:15px;'>{{$com->user->name}}</strong>
                                <time datetime="{{Carbon\Carbon::parse($blog->created_at)->format('M d Y')}}"
                                    class="woocommerce-review__published-date">{{Carbon\Carbon::parse($blog->created_at)->format('M d Y')}}</time>
                            </div>
                            <div class="comment-content">
                                <div class="description">
                                    <p>{{$com->comment}}</p>
                                </div>
                                <div class="reply">
                                    <a href="#respond" class="comment-reply-link" rel="nofollow" wire:click="$set('comment_id', {{$comment->id}})">@lang('user.reply')</a>
                                </div>
                                <!-- .reply -->
                            </div>
                            <!-- .comment-content -->
                        </div>
                        <!-- .comment-text -->
                    </div>
                    <!-- .comment_container -->
                </li>
                <!-- .comment -->
                @endforeach
            </ol>
            <!-- .comment_container -->
        </li>
        <!-- .comment -->
        @endforeach
    </ol>
    <!-- .commentlist -->
    <div class="comment-respond" id="respond">
        <h3 class="comment-reply-title" id="reply-title">@lang('user.Leave_a_Reply')</h3>
        <form class="comment-form" id="commentform" wire:submit.prevent='replay'>
            <p class="comment-notes">
                <span id="email-notes">@lang('user.Your_email_address_will_not_be_published').</span>
                @lang('user.Required_fields_are_marked')
                <span class="required">*</span>
            </p>
            <p class="comment-form-comment">
                <label for="comment">@lang('user.Comment')
                    <span class="required">*</span>
                </label>
                @error('comment') <span class="alert alert-danger">{{ $message }}</span> @enderror

                {!! Form::textarea('comment', old('comment'), ['id' => 'comment','required' => 'required', 'maxlength' =>
                1000,
                'rows' => 8, 'cols' => '45', 'wire:model.lazy' => 'comment']) !!}

            </p>
            <p class="comment-form-author">
                <label for="author">@lang('user.name')
                    <span class="required">*</span>
                </label>
                @error('name') <span class="alert alert-danger">{{ $message }}</span> @enderror
                {!! Form::text('name', old('name'), ['id' => 'name', 'maxlength'
                => 255,
                'rows' => 8, 'required' => 'required', 'wire:model.lazy' => 'name']) !!}

            </p>
            <p class="comment-form-email">
                <label for="email">@lang('user.email')
                    <span class="required">*</span>
                </label>
                @error('email') <span class="alert alert-danger">{{ $message }}</span> @enderror

                {!! Form::email('email', old('email'), ['id' => 'email',
                'maxlength' => 100,
                'rows' => 8, 'required' => 'required',
                'aria-describedby' => 'email-notes', 'wire:model.lazy' => 'email']) !!}
            </p>
            <div class="form-group" style="display: none;">
                <label for="faxonly">Fax Only
                    <input type="checkbox" name="faxonly" id="faxonly" wire:model.lazy='faxonly' />
                </label>
            </div>
            <input type="hidden" name="comment_id"  wire:model.lazy='comment_id' />

            @error('comment_id') <span class="alert alert-danger">{{ $message }}</span> @enderror

            <p class="form-submit">
                <input type="submit" value="@lang('user.Post_Comment')" class="submit">
            </p>
        </form>
    </div>    <!-- #respond -->
    @endif
</div>
