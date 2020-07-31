<section class="brands-carousel">
    <h2 class="sr-only">Brands Carousel</h2>
    <div class="col-full" data-ride="tm-slick-carousel" data-wrap=".brands" data-slick="{&quot;slidesToShow&quot;:6,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;responsive&quot;:[{&quot;breakpoint&quot;:400,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:800,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}}]}">
        <div class="brands">
            @foreach(\App\Tradmark::select('name', 'logo', 'slug')->get() as $brand)
            <div class="item">
                <a href="{{url('/brand/'. $brand->slug)}}">
                    <figure>
                        <figcaption class="text-overlay">
                            <div class="info">
                                <h4>{{$brand->name}}</h4>
                            </div>
                            <!-- /.info -->
                        </figcaption>
                        <img width="145" height="50" style="height:50px; width:145px;" class="img-responsive desaturate" alt="apple" src="{{Storage::url($brand->logo)}}">
                    </figure>
                </a>
            </div>
            @endforeach
            <!-- .item -->
        </div>
    </div>
    <!-- .col-full -->
</section>
