<div id="secondary" class="sidebar-blog widget-area" role="complementary">
    <div class="widget widget_search" id="search-2">
    <form action="{{route('blogs_search')}}" class="search-form" method="get" role="search">
            <label>
                <span class="screen-reader-text">@lang('user.Search_for:')</span>
                <input type="search" name="s" value="" placeholder="@lang('user.Search_for:')" class="search-field">
            </label>
            <input type="submit" value="Search" class="search-submit">
        </form>
        <!-- .search-form -->
    </div>
    <!-- .widget_search -->
    <div class="widget widget_categories" id="categories-2">
        <span class="gamma widget-title">@lang('user.Categories')</span>
        <ul>
            @foreach($categories as $category)
            <li class="cat-item cat-item-53">
                <a href="{{route('show_category', $category->slug)}}">{{$category->name}}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- .widget_categories -->
    <div class="widget techmarket_posts_carousel_widget">
        <section class="section-posts-carousel" id="sidebar-posts-carousel">
            <header class="section-header">
                <h2 class="section-title">@lang('user.Recent_Posts')</h2>
                <div class="custom-slick-nav"></div>
                <!-- .custom-slick-nav -->
            </header>
            <!-- .post-items -->
            <div class="post-item-carousel" data-ride="tm-slick-carousel" data-wrap=".posts" data-slick="{&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#sidebar-posts-carousel .custom-slick-nav&quot;}">
                <div class="posts">
                    @foreach(App\Post::orderBy('id','desc')->get() as $post)
                    <div class="post-item">
                        <a href="{{route('blog', $post->slug)}}" class="post-thumbnail">
                            <div class="post-thumbnail">
                                <img width="270" height="270" alt="" class="attachment-techmarket-blog-carousel wp-post-image" src="{{Storage::url($post->image)}}">
                            </div>
                        </a>
                        <!-- .post-thumbnail -->
                        <div class="post-content">
                            <a href="{{route('blog',$post->slug)}}" class="post-name" tabindex="-1">{{$post->name}}</a>
                            @if($post->commentable)
                            <span class="comments-link">
                                <a href="{{route('blog',$post->slug)}}#comments">@lang('user.Leave_a_comment')</a>
                            </span>
                            @endif
                        </div>
                        <!-- .post-content -->
                    </div>
                    @endforeach
                    <!-- .post-items -->
                </div>
                <!-- .posts-->
            </div>
            <!-- .post-item-carousel -->
        </section>
        <!-- .section-posts-carousel -->
    </div>
    <!-- .techmarket_posts_carousel_widget -->
    <div class="widget widget_tag_cloud">
        <span class="gamma widget-title">@lang('user.Tags_Clouds')</span>
        <div class="tagcloud">
            @foreach(\Spatie\Tags\Tag::where('type', 'posts')->get() as $tag)
                <a style="font-size: 22pt;" class="tag-cloud-link" href="{{route('blogs_tags', $tag->slug)}}">{{$tag->name}}</a>
            @endforeach
        </div>
        <!-- .tagcloud -->
    </div>
    <!-- .widget_tag_cloud -->
</div>
