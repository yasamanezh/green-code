<div class="section-slider-product">
    <div class="widget widget-product card">
        <header class="card-header">
            <span class="title-one">محبوب ترین برندها</span>
            <h3 style="height: 40px"></h3>
        </header>
        <div  class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag" id="carousel-brand">
            <div class="owl-stage-outer">
                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                    @if($brands)
                        @foreach($brands as $brand)
                            <div class="owl-item " style=" margin-left: 10px;">
                                <div class="item">
                                    <a href="{{route('Brands',$brand->slug)}}" >
                                        <img src="/storage/{{$brand->img}}"  class="img-fluid" alt="{{$brand->title}}">
                                    </a>
                                    <div>
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
@push('jsPanel')
    <script>
        //    slider-product-------------------
        $("#carousel-brand").owlCarousel({
            rtl: true,
            margin: 0,
            nav: false,
            autoplay: true,
            autoplayTimeout: 1000,
            loop: true,

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

                },
                1400: {
                    items: 6,

                }
            }
        });
    </script>
@endpush


