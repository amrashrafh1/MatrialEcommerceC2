@if(Auth::check())
<div class="techmarket-advanced-reviews" id="reviews">
    <div class="advanced-review row">
        <div class="advanced-review-rating">
            <h2 class="based-title">@lang('user.Review') ({{DB::table('reviews')->where('reviewrateable_id', $this->product->id)->where('approved', 1)
                ->count()}})</h2>
            <div class="avg-rating">
                <span class="avg-rating-number">{{$this->product->averageRating(1, true)[0]}}</span>
                <div title="Rated 5.0 out of 5" class="star-rating">
                    <span style="width:{{$this->product->averageRating(null, true)[0] * 2 * 10}}%"></span>
                </div>
            </div>
            <!-- /.avg-rating -->
            <div class="rating-histogram">
                <div class="rating-bar">
                    <div title="Rated 5 out of 5" class="star-rating">
                        <span style="width:100%"></span>
                    </div>
                    <div class="rating-count">{{DB::table('reviews')->where('reviewrateable_id', $this->product->id)->where('approved', 1)
                        ->where('rating', 5)->count()}}</div>
                    <div class="rating-percentage-bar">
                        <span class="rating-percentage" style="width:100%"></span>
                    </div>
                </div>
                <div class="rating-bar">
                    <div title="Rated 4 out of 5" class="star-rating">
                        <span style="width:80%"></span>
                    </div>
                    <div class="rating-count zero">{{DB::table('reviews')->where('reviewrateable_id', $this->product->id)->where('approved', 1)
                        ->where('rating', 4)->count()}}</div>
                    <div class="rating-percentage-bar">
                        <span class="rating-percentage" style="width:0%"></span>
                    </div>
                </div>
                <div class="rating-bar">
                    <div title="Rated 3 out of 5" class="star-rating">
                        <span style="width:60%"></span>
                    </div>
                    <div class="rating-count zero">{{DB::table('reviews')->where('reviewrateable_id', $this->product->id)->where('approved', 1)
                        ->where('rating', 3)->count()}}</div>
                    <div class="rating-percentage-bar">
                        <span class="rating-percentage" style="width:0%"></span>
                    </div>
                </div>
                <div class="rating-bar">
                    <div title="Rated 2 out of 5" class="star-rating">
                        <span style="width:40%"></span>
                    </div>
                    <div class="rating-count zero">{{DB::table('reviews')->where('reviewrateable_id', $this->product->id)->where('approved', 1)
                        ->where('rating', 2)->count()}}</div>
                    <div class="rating-percentage-bar">
                        <span class="rating-percentage" style="width:0%"></span>
                    </div>
                </div>
                <div class="rating-bar">
                    <div title="Rated 1 out of 5" class="star-rating">
                        <span style="width:20%"></span>
                    </div>
                    <div class="rating-count zero">{{DB::table('reviews')->where('reviewrateable_id', $this->product->id)->where('approved', 1)
                        ->where('rating', 1)->count()}}</div>
                    <div class="rating-percentage-bar">
                        <span class="rating-percentage" style="width:0%"></span>
                    </div>
                </div>
            </div>
            <!-- /.rating-histogram -->
        </div>
        <!-- /.advanced-review-rating -->
        <div class="advanced-review-comment">
            <div id="review_form_wrapper">
                <div id="review_form">
                    <div class="comment-respond" id="respond">
                        <h3 class="comment-reply-title" id="reply-title">@lang('user.Add_a_review')</h3>
                        <form novalidate="" class="comment-form" id="commentform" wire:submit.prevent='addReview'>
                            <div class="comment-form-rating">
                                <label>@lang('user.Your_Rating')</label>
                                <p class="rating">
                                <div class="stars">
                                      <input class="star star-5" id="star-5" type="radio" name="star" value="5" wire:model='review'/>
                                      <label class="star star-5" for="star-5"></label>
                                      <input class="star star-4" id="star-4" type="radio" name="star" value="4" wire:model='review'/>
                                      <label class="star star-4" for="star-4"></label>
                                      <input class="star star-3" id="star-3" type="radio" name="star" value="3" wire:model='review'/>
                                      <label class="star star-3" for="star-3"></label>
                                      <input class="star star-2" id="star-2" type="radio" name="star" value="2" wire:model='review'/>
                                      <label class="star star-2" for="star-2"></label>
                                      <input class="star star-1" id="star-1" type="radio" name="star" value="1" wire:model='review'/>
                                      <label class="star star-1" for="star-1"></label>
                                  </div>
                                  @error('review') <span class="alert alert-danger">{{ $message }}</span> @enderror
                                </p>
                            </div>
                            <p class="comment-form-comment">
                                <label for="comment">@lang('user.Your_Review')</label>
                                <textarea aria-required="true" rows="8" cols="45" name="comment" id="comment" wire:model.lazy='comment'></textarea>
                                @error('comment') <span class="alert alert-danger">{{ $message }}</span> @enderror
                            </p>
                            <p class="comment-form-author">
                                <label for="author">@lang('admin.name')
                                    <span class="required">*</span>
                                </label>
                                <input type="text" aria-required="true" size="30" value="" name="author" id="author" wire:model.lazy='name'>
                                @error('name') <span class="alert alert-danger">{{ $message }}</span> @enderror
                            </p>
                            <p class="comment-form-email">
                                <label for="email">@lang('admin.email')
                                    <span class="required">*</span>
                                </label>
                                <input type="text" aria-required="true" size="30" value="" name="email" id="email" wire:model.lazy='email'>
                                @error('email') <span class="alert alert-danger">{{ $message }}</span> @enderror
                            </p>
                            <p class="form-submit">
                                <input type="submit" value="Add Review" class="submit" id="submit" name="submit">
                                <input type="hidden" id="comment_post_ID" value="185" name="comment_post_ID">
                                <input type="hidden" value="0" id="comment_parent" name="comment_parent">
                            </p>
                        </form>
                        <!-- /.comment-form -->
                    </div>
                    <!-- /.comment-respond -->
                </div>
                <!-- /#review_form -->
            </div>
            <!-- /#review_form_wrapper -->
        </div>
        <!-- /.advanced-review-comment -->
    </div>
    <!-- /.advanced-review -->
    <div id="comments">
        <ol class="commentlist">
            @foreach($this->product->getRecentRatings($this->product->id, 10, 'desc') as $rating)
            <li id="li-comment-{{$rating->id}}" class="comment byuser comment-author-admin bypostauthor even thread-even depth-1">
                <div class="comment_container" id="comment-{{$rating->id}}">
                    <div class="comment-text">
                        <div class="star-rating">
                            <span style="width:{{$rating->rating * 2 * 10}}%">Rated
                                <strong class="rating">{{$rating->rating}}</strong> out of 5</span>
                        </div>
                        <p class="meta">
                            <strong itemprop="author" class="woocommerce-review__author">{{$rating->title}}</strong>
                            <span class="woocommerce-review__dash">&ndash;</span>
                            <time datetime="2017-06-21T08:05:40+00:00" itemprop="datePublished" class="woocommerce-review__published-date">{{\Carbon\Carbon::createFromTimeStamp(strtotime($rating->created_at))->diffForHumans()}}</time>
                        </p>
                        <div class="description">
                            <p>{{$rating->body}}</p>
                        </div>
                        <!-- /.description -->
                    </div>
                    <!-- /.comment-text -->
                </div>
                <!-- /.comment_container -->
            </li>
            @endforeach
            <!-- /.comment -->
        </ol>
        <!-- /.commentlist -->
    </div>
    <!-- /#comments -->
</div>
<!-- /.techmarket-advanced-reviews -->

@push('css')
<style>
div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>

@endpush
@else
<div>
    @lang('user.Login_to_leave_review')
</div>
@endif
