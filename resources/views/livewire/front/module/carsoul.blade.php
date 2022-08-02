<div class="section-slider-product">
    <div class="widget widget-product card">
        <header class="card-header">
            <span class="title-one">{{$carsouls->title}}</span>
            <h3 class="card-title"><a href="{{$carsouls->link ?  $carsouls->link :''}}">مشاهده همه</a></h3>
        </header>
        <div class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag"
             id="carousel_{{$carsouls->id}}">
            <div class="owl-stage-outer">
                <div class="owl-stage"
                     style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                    @if($products)
                        @foreach($products as $product)
                            <div class="owl-item @if($i<=4) active   @endif"
                                 style="width: 309.083px; margin-left: 10px;">
                                <div class="item">
                                    <a href="{{route('SingleProduct',$product->slug)}}">
                                        <div class="stars-plp ">
                                            @for($i=1;$i<=5;$i++)
                                                <span class="mdi mdi-star @if($i <= $this->calculateRate($product->id) ) active @endif"></span>
                                            @endfor
                                        </div>
                                        <img src="/storage/{{$product->thumbnail}}" class="img-fluid"
                                             alt="{{$product->title}}" title="{{$product->title}}">
                                    </a>
                                    <h2 class="post-title">
                                        <a href="{{route('SingleProduct',$product->slug)}}">
                                            {!! \Illuminate\Support\Str::limit($product->title,50,'...') !!}
                                        </a>
                                    </h2>
                                    <div>
                                        @if($product->price == 0)
                                            0 تومان
                                            @if($product->quantity == 0 )
                                                <span style="color: #d7bd3b;">ناموجود</span>
                                            @endif

                                        @elseif(\App\Helper\Price::priceProdct($product->id ) == 1)
                                            <span class="text-center font-size-14">{{number_format($product->price)}} </span>
                                            <span class="toman">تومان</span>
                                            @if($product->quantity == 0 )
                                                <span style="color: #d7bd3b;">ناموجود</span>
                                            @endif
                                        @else
                                            <div class="text-center">
                                                <s class=" font-size-12">{{$product->price}} تومان</s>
                                                <br>
                                                @if($product->quantity == 0 )
                                                    <span style="color: #d7bd3b;">ناموجود</span>
                                                @endif
                                                <span class="new-price-discount" style="float: unset">%{{(1-\App\Helper\Price::priceProdct($product->id ))*100}}</span>
                                                <span class="font-size-14"> {{number_format(\App\Helper\Price::priceProdct($product->id )*$product->price)}}</span>
                                                <span class="toman">تومان</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('jsBeforMain')
        <script>
            //    slider-product-------------------
            $("#carousel_{{$carsouls->id}}").owlCarousel({
                rtl: true,
                margin: {{$carsouls->margin}},
                nav: true,
                autoplay: {{$carsouls->autoplay}},
                autoplayTimeout: {{$carsouls->autoplayTimeout}},
                loop: {{$carsouls->loop}},

                navText: ['<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>'],
                dots: {{$carsouls->dots}},
                responsiveClass: true,
                responsive: {
                    0: {
                        items: {{$carsouls->mobile_count}},
                        slideBy: {{$carsouls->mobile_count}}
                    },
                    576: {
                        items: {{$carsouls->mobile_count}},
                        slideBy: {{$carsouls->mobile_count}}
                    },
                    768: {
                        items: {{$carsouls->tablet_count}},
                        slideBy: {{$carsouls->tablet_count}}
                    },
                    992: {
                        items: {{$carsouls->computer_count}},
                        slideBy: {{$carsouls->computer_count}}
                    },
                    1400: {
                        items: {{$carsouls->computer_count}},
                        slideBy: {{$carsouls->computer_count}}
                    }
                }
            });
        </script>
    @endpush
</div>



