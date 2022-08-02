<div>
    @if($product->related)
        <div class="section-slider-product mt-3">
            <div class="widget widget-product card">
                <header class="card-header">
                    <span class="title-one">محصولات مرتبط</span>
                    <h3 style="height: 40px"></h3>
                </header>
                <div  class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                            @foreach($prorelateds as $relate)
                                <div class="owl-item @if($i<=4) active   @endif" style=" margin-left: 10px;">
                                    <div class="item">
                                        <a href="{{route('SingleProduct',$relate->slug)}}">
                                            <img src="/storage/{{$relate->image}}"  class="img-fluid" alt="">
                                        </a>
                                        <h2 class="post-title">
                                            <a href="{{route('SingleProduct',$relate->slug)}}">
                                                {{$relate->title}}
                                            </a>
                                        </h2>
                                        <div>
                                            <div class="card-vertical-product-price" >
                                                @if($relate->price ==0)
                                                    {{number_format($relate->price)}}  تومان
                                                @else
                                                    @if($this->priceProdct($relate->id ) == 1)
                                                        <span class="text-center font-size-14">{{number_format($product->price)}} </span><span class="toman">تومان</span>
                                                    @else
                                                        <s class=" font-size-12">{{number_format($product->price)}} تومان</s>
                                                        <br>

                                                        <span class="new-price-discount ">%{{(1-$this->priceProdct($product->id ))*100}}</span>
                                                        <span class="font-size-14"> {{number_format($this->priceProdct($product->id )*$product->price)}}</span>
                                                        <span class="toman">تومان</span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif

        @push('jsBeforMain')
            <script src="{{asset('assets/js/bootstrap-slider.min.js')}}"></script>
            <!--main----------------------------------------->
            <script>
                //    slider-product-------------------
                $(".product-carousel").owlCarousel({
                    rtl: true,
                    margin: 10,
                    nav: true,
                    autoplay: false,

                    loop: false,

                    navText: ['<i class="fa fa-angle-right"></i>', '<i class="fa fa-angle-left"></i>'],
                    dots: false,
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
                            slideBy: 4
                        },
                        1400: {
                            items: 6,
                            slideBy: 4
                        }
                    }
                });


            </script>
        @endpush
</div>
