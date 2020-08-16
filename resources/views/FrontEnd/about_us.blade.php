@extends('layouts.app')

@section('content')
<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">Home</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                @lang('user.about_us')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="type-page hentry">
                        <header class="entry-header">
                            <div class="page-featured-image">
                                <img width="1920" height="1391" alt="" class="attachment-full size-full wp-post-image" src="assets/images/products/about-header.jpg">
                            </div>
                            <!-- .page-featured-image -->
                            <div class="page-header-caption">
                                <h1 class="entry-title">@lang('user.about_us')</h1>
                                <p class="entry-subtitle">Passion may be a friendly or eager interest in or admiration for a proposal,
                                    <br> cause, discovery, or activity or love to a feeling of unusual excitement. </p>
                            </div>
                            <!-- .page-header-caption -->
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="about-features row">
                                <div class="col-md-4">
                                    <div class="single-image">
                                        <img alt="" class="" src="{{url('/')}}/FrontEnd/images/products/3column1.jpg">
                                    </div>
                                    <!-- .single_image -->
                                    <div class="text-block">
                                        <h2 class="align-top">What we really do?</h2>
                                        <p>Donec libero dolor, tincidunt id laoreet vitae,ullamcorper eu tortor. Maecenas pellentesque,dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>
                                    </div>
                                    <!-- .text_block -->
                                </div>
                                <!-- .col -->
                                <div class="col-md-4">
                                    <div class="single-image">
                                        <img alt="" class="" src="{{url('/')}}/FrontEnd/images/products/3column2.jpg">
                                    </div>
                                    <!-- .single_image -->
                                    <div class="text-block">
                                        <h2 class="align-top">Our Vision</h2>
                                        <p>Donec libero dolor, tincidunt id laoreet vitae,ullamcorper eu tortor. Maecenas pellentesque,dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>
                                    </div>
                                    <!-- .text_block -->
                                </div>
                                <!-- .col -->
                                <div class="col-md-4">
                                    <div class="single-image">
                                        <img alt="" class="" src="{{url('/')}}/FrontEnd/images/products/3column2.jpg">
                                    </div>
                                    <!-- .single_image -->
                                    <div class="text-block">
                                        <h2 class="align-top">History of Beginning</h2>
                                        <p>Donec libero dolor, tincidunt id laoreet vitae,ullamcorper eu tortor. Maecenas pellentesque,dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>
                                    </div>
                                    <!-- .text_block -->
                                </div>
                                <!-- .col -->
                            </div>
                            <!-- .about-features -->
                            <div class="light-bg team-member-wrapper">
                                <div class="col-full">
                                    <div class="row">
                                        @foreach($teams as $team)
                                        <div class="col-sm-2">
                                            <div class="team-member">
                                                <img src="{{Storage::url($team->image)}}" alt="">
                                                <div class="profile">
                                                    <h3>{{$team->name}}
                                                        <small class="description">{{$team->job_title}}</small>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <!-- .col -->
                                    </div>
                                    <!-- .row -->
                                </div>
                                <!-- .container -->
                            </div>
                            <!-- .team-member-wrapper -->
                            <div class="row accordion-block">
                                <div class="text-boxes col-sm-7">
                                    <div class="row first-row">
                                        <div class="col-sm-6">
                                            <div class="text-block">
                                                <h3 class="highlight">What we really do?</h3>
                                                <p>Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor. Maecenas pellentesque, dui vitae iaculis mattis, tortor nisi faucibus magna, vitae ultrices lacus purus vitae metus. Ut nec odio facilisis, ultricies nunc eget, fringilla orci.</p>
                                            </div>
                                            <!-- .text-block -->
                                        </div>
                                        <!-- .col -->
                                        <div class="col-sm-6">
                                            <div class="text-block">
                                                <h3 class="highlight">Our Vision</h3>
                                                <p>Vestibulum velit nibh, egestas vel faucibus vitae, feugiat sollicitudin urna. Praesent iaculis id ipsum sit amet pretium. Aliquam tristique sapien nec enim euismod, scelerisque facilisis arcu consectetur. Vestibulum velit nibh, egestas vel faucibus vitae.</p>
                                            </div>
                                            <!-- .text-block -->
                                        </div>
                                        <!-- .col -->
                                    </div>
                                    <!-- .row -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="text-block">
                                                <h3 class="highlight">What we really do?</h3>
                                                <p>Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor. Maecenas pellentesque, dui vitae iaculis mattis, tortor nisi faucibus magna, vitae ultrices lacus purus vitae metus. Ut nec odio facilisis, ultricies nunc eget, fringilla orci.</p>
                                            </div>
                                            <!-- .text-block -->
                                        </div>
                                        <!-- .col -->
                                        <div class="col-sm-6">
                                            <div class="text-block">
                                                <h3 class="highlight">Our Vision</h3>
                                                <p>Vestibulum velit nibh, egestas vel faucibus vitae, feugiat sollicitudin urna. Praesent iaculis id ipsum sit amet pretium. Aliquam tristique sapien nec enim euismod, scelerisque facilisis arcu consectetur. Vestibulum velit nibh, egestas vel faucibus vitae.</p>
                                            </div>
                                            <!-- .text-block -->
                                        </div>
                                        <!-- .col -->
                                    </div>
                                    <!-- .row -->
                                </div>
                                <!-- .text-boxes -->
                                <div class="about-accordion col-sm-5">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <h3 class="about-accordion-title">What can we do for you ?</h3>
                                            <div id="accordion" role="tablist" aria-multiselectable="true">
                                                @foreach($services as $index => $service)
                                                <div class="card">
                                                    <div class="card-header" role="tab" id="heading{{$index}}">
                                                        <h5 class="mb-0">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$index}}" class='@if($loop->first)  @else collapsed @endif' aria-expanded="@if($loop->first) true @else false @endif" aria-controls="collapse{{$index}}">
                                                                <i class="fa-icon"></i>
                                                                {{$service->name}}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                    <!-- .card-header -->
                                                    <div id="collapse{{$index}}" class="@if($loop->first)  show  @else collapse  @endif" role="tabpanel" aria-labelledby="heading{{$index}}">
                                                        <div class="card-block">
                                                            {!!$service->description!!}
                                                        </div>
                                                    </div>
                                                    <!-- .collapse -->
                                                </div>
                                                @endforeach
                                                <!-- .card -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .entry-content -->
                    </div>
                    <!-- .hentry -->
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
        </div>
        <!-- .row -->
    </div>
    <!-- .col-full -->
</div>
@endsection
