@extends('layouts.app')
@if(!isset($categories))
@php
$categories = \App\Category::where('status', 1)->where('category_id', NULL)
->with('categories')->get();
@endphp
@endif
@section('content')
<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                @lang('user.blog')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    @foreach($blogs as $blog)
                    <article class="post format-image hentry">
                        <div class="media-attachment">
                            <div class="post-thumbnail">
                                <a href="{{route('blog', $blog->slug)}}">
                                    <img alt="" class="wp-post-image" src="{{Storage::url($blog->image)}}">
                                </a>
                            </div>
                        </div>
                        <!-- .media-attachment -->
                        <div class="content-body">
                            <header class="entry-header">
                                <h1 class="entry-title">
                                    <a rel="bookmark" href="{{route('blog', $blog->slug)}}">{{$blog->title}}</a>
                                </h1>
                                <!-- .entry-title -->
                                <div class="entry-meta">
                                    <span class="posted-on">
                                        <a href="{{route('blog', $blog->slug)}}" rel="bookmark">
                                            <time datetime="{{Carbon\Carbon::parse($blog->created_at)->format('M d Y')}}" class="entry-date published">{{Carbon\Carbon::parse($blog->publish_at)->format('M d Y')}}</time>
                                            <time datetime="{{Carbon\Carbon::parse($blog->updated_at)->format('M d Y')}}" class="updated">{{Carbon\Carbon::parse($blog->updated_at)->format('M d Y')}}</time>
                                        </a>
                                    </span>
                                    <span class="author">
                                        <a title="{{$blog->user->name}}" href="#" rel="author">{{$blog->user->name}}</a>
                                    </span>
                                </div>
                                <!-- .entry-meta -->
                            </header>
                            <!-- .entry-header -->
                            <div class="entry-content">

                                <p>{!! Str::limit($blog->content, 200) !!}</p>
                            </div>
                            <!-- .post-excerpt -->
                            <div class="post-readmore">
                                <a class="btn btn-primary" href="{{route('blog', $blog->slug)}}">@lang('user.read_more')</a>
                            </div>
                            <!-- .post-readmore -->
                            <span class="comments-link">
                                <a href="{{route('blog', $blog->slug)}}">@lang('user.Leave_a_comment')</a>
                            </span>
                            <!-- .comments-link -->
                        </div>
                    </article>
                    @endforeach
                    {!! $blogs->links() !!}
                    {{-- <nav class="navigation pagination" id="post-navigation">
                        <span class="screen-reader-text">Posts navigation</span>
                        <div class="nav-links">
                            <ul class="page-numbers">
                                <li><a href="#" class="page-numbers current">1</a></li>
                                <li>
                                    <span class="page-numbers">2</span>
                                </li>
                                <li><a href="#" class="next page-numbers">Next</a></li>
                            </ul>
                            <!-- .page-numbers -->
                        </div>
                        <!-- .nav-links -->
                    </nav> --}}
                    <!-- .navigation -->
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
            @include('FrontEnd.blogs.side', ['categories' => $categories])

        </div>
        <!-- .row -->
    </div>
    <!-- .col-full -->
</div>
@endsection
