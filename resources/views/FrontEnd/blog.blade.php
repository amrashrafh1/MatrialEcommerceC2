@extends('layouts.app')
@section('content')
@if(!isset($categories))
@php
$categories = \App\Category::where('status', 1)->where('category_id', NULL)
->with('categories')->get();
@endphp
@endif
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
                    <article class="post format-image">
                        <div class="media-attachment">
                            <div class="post-thumbnail">
                                <img width="1433" height="560" alt="" class="wp-post-image"
                                    src="{{Storage::url($blog->image)}}">
                            </div>
                        </div>
                        <header class="entry-header">
                            <h1 class="entry-title">{{$blog->name}}
                                <span class="comments-link">
                                <a href="#comments">{{($blog->comments)?count($blog->comments):0}}</a>
                                </span>
                            </h1>
                            <!-- .entry-title -->
                            <div class="entry-meta">
                                <!-- .cat-links -->
                                <span class="posted-on">
                                    <a rel="bookmark" href="#">
                                        <time datetime="{{Carbon\Carbon::parse($blog->publish_at)->format('M d Y')}}" class="entry-date published">{{Carbon\Carbon::parse($blog->publish_at)->format('M d Y')}}</time>
                                    </a>
                                </span>
                                <!-- .posted-on -->
                                <span class="author">
                                    <a rel="author" title="Posts by {{$blog->user->name}}" href="#">{{$blog->user->name}}</a>
                                </span>
                                <!-- .author -->
                            </div>
                            <!-- .entry-meta -->
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content" itemprop="articleBody">
                           {!! $blog->content !!}
                            <!-- .row -->
                        </div>
                        <!-- .entry-content -->
                    </article>
                    <!-- .post -->
                    <div class="post-author-info">
                        <div class="media">
                            <div class="media-left media-middle">
                                <a href="#">
                                    <img src="assets/images/blog/author.jpg" alt="">
                                </a>
                            </div>
                            <!-- .media-left -->
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="#">{{$blog->user->name}}</a>
                                </h4>
                            </div>
                            <!-- .media-body -->
                        </div>
                        <!-- .media -->
                    </div>
                    <!-- .post-author-info -->
                    <nav aria-label="Post Navigation" class="navigation post-navigation" id="post-navigation">
                        <span class="screen-reader-text">Post navigation</span>
                        <div class="nav-links">
                            @if($previous)
                            <div class="nav-previous">
                                <a rel="prev" href="{{route('blog', $previous->slug)}}">
                                    <span class="meta-nav">←</span>{{$previous->title}}</a>
                            </div>
                            @endif
                            <!-- /.nav-previous -->
                            @if($next)
                            <div class="nav-next">
                                <a href="{{route('blog', $next->slug)}}" rel="next">{{$next->title}}
                                    <span class="meta-nav">→</span>
                                </a>
                            </div>
                            @endif
                            <!-- /.nav-next -->
                        </div>
                        <!-- /.nav-links -->
                    </nav>
                    <!-- /.post-navigation -->

                    @livewire('front-end.blog.replay', ['blog' => $blog])
                        <!-- #respond -->
                    <!-- .comments-area -->
                </main>
                <!-- #main -->
            </div>
            @include('FrontEnd.blogs.side', ['categories' => $categories])
            <!-- #primary -->
        </div>
        <!-- .row -->
    </div>
    <!-- .col-full -->
</div>
@endsection
