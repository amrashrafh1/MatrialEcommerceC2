@extends('Admin.layouts.app', ['activePage' => 'seller-management', 'titlePage' => trans('admin.stores')])
@section('content')
<div class="container-fluid pt-8">
    <div class="col-md-12">
        @include('sweetalert::alert')

        <div class="widget-extra body-req card light bordered">
            <div class="card-header">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a href="{{route('seller.stores.index', $store->seller->id)}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form" id="element">
                <div id="comments">
                    <ul class="commentlist">
                @forelse($store->getAllRatings($store->id, 'desc') as $rating)
                    <li id="li-comment-{{$rating->id}}" class="comment byuser comment-author-admin bypostauthor even thread-even depth-1">
                        <div class="comment_container" id="comment-{{$rating->id}}">
                            <div class="comment-text">
                                <div class="star-rating">
                                    <span style="width:{{$rating->rating * 2 * 10}}%">Rated
                                        <strong class="rating">{{$rating->rating}}</strong> out of 5</span>
                                </div>
                                <div class="description " style='color:#555;'>
                                    <p class='p-2'>@lang('admin.comment'): {{$rating->body}}</p>
                                </div>
                                <p class="meta">
                                    <strong itemprop="author" class="woocommerce-review__author">{{$rating->title}}</strong>
                                    <span class="woocommerce-review__dash">&ndash;</span>
                                    <time datetime="2017-06-21T08:05:40+00:00" itemprop="datePublished" class="woocommerce-review__published-date">{{\Carbon\Carbon::createFromTimeStamp(strtotime($rating->created_at))->diffForHumans()}}</time>
                                    @if(!$rating->approved)
                                    <div class='ml-5'>
                                        <a class='btn btn-primary' href='{{route('store.reviews.approve', $rating->id)}}'>@lang('admin.accept')</a>
                                    </div>
                                    @else
                                    <div class='ml-5'>
                                        <a class='btn btn-info disabled' disabled href='#'>@lang('admin.approved')</a>
                                    </div>
                                    @endif
                                </p>

                                <!-- /.description -->
                            </div>
                            <!-- /.comment-text -->
                        </div>
                        <!-- /.comment_container -->
                    </li>
                    @empty
                    <div class='m-5 alert alert-danger'>
                        @lang('admin.sEmptyTable')
                    </div>
                @endforelse
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

@stop
