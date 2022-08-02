<div>
    <div class="special">
        <div class="section-slider-product flex " style="background: {{$spesials->background}};border: none ">
            <a href="{{$spesials->link}}" class="c-swiper-specials__title c-swiper-specials__title--incredible" title="پیشنهاد شگفت‌انگیز">
                <img src="{{asset('assets/images/b6c724a0.png')}}" alt="پیشنهاد شگفت‌انگیز">
                <div class="o-btn c-swiper-specials__btn">مشاهده همه</div>
            </a>
            <div class="widget widget-product card">
                <div  class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag" style="background: {{$spesials->background}}" id="carousel_spesial{{$spesials->id}}">
                    <div class="owl-stage-outer" style="background: {{$spesials->background}} !important;">
                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;border-bottom:none !important;">
                            @if($products)
                                @foreach($products as $product)
                                    <div class="owl-item @if($i<=4) active   @endif" style="width: 309.083px; margin-left: 10px;background: #fff !important;margin-bottom: 20px;">
                                        <div class="item">
                                            <a href="{{route('SingleProduct',$product->slug)}}">
                                                <img  src="/storage/{{$product->thumbnail}}"  class="img-fluid" alt="{{$product->title}}" title="{{$product->title}}"  >
                                            </a>
                                            <h2 class="post-title" style="height:45px">
                                                <a href="{{route('SingleProduct',$product->slug)}}">
                                                    {!! \Illuminate\Support\Str::limit($product->title,24,'...') !!}
                                                </a>
                                            </h2>
                                            <div>
                                                <div class="card-vertical-product-price" style="height: 80px" >
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
                                                        <div  style="text-align: center;">

                                                            <s class=" font-size-12">{{$product->price}} تومان</s>
                                                            <br>
                                                            @if($product->quantity == 0 )
                                                                <span style="color: #d7bd3b;">ناموجود</span>
                                                            @endif
                                                            <span class="new-price-discount ">%{{(1-\App\Helper\Price::priceProdct($product->id ))*100}}</span>
                                                            <span class="font-size-14"> {{number_format(\App\Helper\Price::priceProdct($product->id )*$product->price)}}</span>
                                                            <span class="toman">تومان</span>

                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('jsBeforMain')
        <script >
            //    slider-product-------------------
            $("#carousel_spesial{{$spesials->id}}").owlCarousel({
                rtl: true,
                margin: 5,
                nav: true,
                autoplay: true,
                autoplayTimeout: 3000,
                loop: true,

                navText: ['<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>'],
                dots: true,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        slideBy: 1
                    },
                    576: {
                        items: 2,
                        slideBy: 2
                    },
                    768: {
                        items: 3,
                        slideBy: 3
                    },
                    992: {
                        items: 6,
                        slideBy: 6
                    },
                    1400: {
                        items: 6,
                        slideBy: 6
                    }
                }
            });
        </script>
    @endpush
</div>



