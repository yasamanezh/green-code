<div class="promo-single">
    <div class="widget-suggestion card">
        <header class="card-header cart-sidebar">
            <h3 class="card-title ts-3">پیشنهادهای لحظه‌ای</h3>
        </header>
        <div id="progressBar">
            <div class="slide-progress" style="width: 100%; transition: width 5000ms ease 0s;"></div>
        </div>
        <div id="suggestion-slider" class="owl-carousel owl-theme owl-rtl owl-loaded owl-drag">
            <div class="owl-stage-outer">
                <div class="owl-stage"  style="transform: translate3d(1245px, 0px, 0px); transition: all 0.25s ease 0s; width: 1992px;">
                    @foreach($products as $product)
                    <div class="owl-item @if($loop->first) cloned active  @endif" style="width: 249px;">
                        <div class="item">
                            <a href="{{route('SingleProduct',$product->slug)}}">
                                <img src="/storage/{{$product->thumbnail}}" class="w-100" alt="">
                            </a>
                            <h3 class="product-title">

                                <a href="{{route('SingleProduct',$product->slug)}}">{!! \Illuminate\Support\Str::limit($product->title,30,'...') !!}</a>
                            </h3>
                            <div class="price">
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
                                     <s class=" font-size-12">{{$product->price}} تومان</s>
                                        <br>
                                    @if($product->quantity == 0 )
                                        <span style="color: #d7bd3b;">ناموجود</span>
                                    @endif
                                        <span class="new-price-discount ">%{{(1-\App\Helper\Price::priceProdct($product->id ))*100}}</span>
                                        <span class="font-size-14"> {{number_format(\App\Helper\Price::priceProdct($product->id )*$product->price)}}</span>
                                        <span class="toman">تومان</span>

                                @endif
                                    <div class="stars-plp ">
                                        @for($i=1;$i<=5;$i++)
                                            <span class="mdi mdi-star @if($i <= $this->calculateRate($product->id) ) active @endif"></span>
                                        @endfor
                                    </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="owl-nav disabled">
                <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
                <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
            </div>
            <div class="owl-dots disabled"></div>
            <div class="owl-nav disabled">
                <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
                <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
            </div>
            <div class="owl-dots disabled"></div>
        </div>
    </div>
</div>
