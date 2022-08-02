<div class="page-contents">
    <div class="arrivals-product">
        <div class="main-product-tab-area">
            <div class="tab-menu mb-5">
                <ul class="nav tabs-area">
                    <li wire:ignore class="nav-item nav-active">
                        <a href="#" class="nav-link" data-toggle="tab">همه</a>
                    </li>
                    <li wire:ignore class="nav-item">
                        <a href="#" class="nav-link" data-toggle="tab">پرفروش‌ترین</a>
                    </li>
                    <li wire:ignore class="nav-item">
                        <a href="#" class="nav-link" data-toggle="tab">جدید ترین ها</a>
                    </li>
                    <li wire:ignore class="nav-item">
                        <a href="#" class="nav-link" data-toggle="tab">ارزان‌ترین</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <section class="main-content">
                    <ul class="content-area">
                        <li wire:ignore.self class="item-content" style="display:block;">
                            <a href="#" class="link-content">
                            </a>
                            @foreach($products as $product)
                                <div class="col-lg-3 col-md-4 col-xs-12 pull-right mb-3">
                                    <a href="#" class="link-content">
                                    </a>
                                    <div class="product-vertical"><a href="{{route('SingleProduct',$product->slug)}}"
                                                                     class="link-content">
                                        </a>
                                        <div class="vertical-product-thumb"><a
                                                    href="{{route('SingleProduct',$product->slug)}}"
                                                    class="link-content">
                                            </a><a href="{{route('SingleProduct',$product->slug)}}">
                                                <img src="/storage/{{$product->image}}" alt="{{$product->title}}">
                                            </a>
                                        </div>
                                        <div class="card-vertical-product-content">
                                            <div class="card-vertical-product-title">
                                                <a href="{{route('SingleProduct',$product->slug)}}">
                                                    {{$product->title}}
                                                </a>
                                            </div>
                                            <div class="card-vertical-product-price">
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
                                                    <div>
                                                        <s class=" font-size-12">{{$product->price}} تومان</s>
                                                        <br>
                                                        @if($product->quantity == 0 )
                                                            <span>ناموجود</span>
                                                        @endif
                                                        <span class="new-price-discount" style="float: unset">%{{(1-\App\Helper\Price::priceProdct($product->id ))*100}}</span>
                                                        <span class="font-size-14"> {{number_format(\App\Helper\Price::priceProdct($product->id )*$product->price)}}</span>
                                                        <span class="toman">تومان</span>
                                                    </div>
                                                @endif
                                                <span class="price-currency"
                                                      wire:click.prevent="calculateRate({{$product->id}})"></span>
                                                <div class="stars-plp">
                                                    @for($i=1;$i<=5;$i++)
                                                        <span class="mdi mdi-star @if($i <= $this->calculateRate($product->id) ) active @endif"></span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="product-actions-secondary section-style">
                                                <div class="heart" title="افزودن به لیست علاقه مندی">
                                                    @if($this->isLike($product->id))
                                                        <span class="mdi mdi-heart heart-active"
                                                              wire:click.prevent="removeToWishlist({{$product->id}})"></span>
                                                    @else
                                                        <span class="mdi mdi-heart"
                                                              wire:click.prevent="addToWishlist({{$product->id}})"></span>
                                                    @endif
                                                </div>
                                                <a href="{{route('SingleProduct',$product->slug)}}"
                                                   class="product-introduction-cart" title=" مشاهده کالا">
                                                            <span class="c-introduction">
                                                               مشاهده کالا
                                                            </span>
                                                </a>
                                                <div class="comparison" title="افزودن برای مقایسه"
                                                     wire:click.prevent="compare({{$product->id}})">
                                                    <i class="fa fa-random" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </li>
                        <li wire:ignore.self class="item-content">
                            <a href="#" class="link-content"> </a>
                            @foreach($bestellers as $besteller)

                                <div class="col-lg-3 col-md-4 col-xs-12 pull-right mb-3">
                                    <a href="#" class="link-content">
                                    </a>
                                    <div class="product-vertical"><a href="{{route('SingleProduct',$besteller->slug)}}"
                                                                     class="link-content">
                                        </a>
                                        <div class="vertical-product-thumb"><a
                                                    href="{{route('SingleProduct',$besteller->slug)}}"
                                                    class="link-content">
                                            </a><a href="{{route('SingleProduct',$besteller->slug)}}">
                                                <img src="/storage/{{$besteller->image}}" alt="{{$besteller->title}}">
                                            </a>
                                        </div>
                                        <div class="card-vertical-product-content">
                                            <div class="card-vertical-product-title">
                                                <a href="{{route('SingleProduct',$besteller->slug)}}">
                                                    {{$besteller->title}}
                                                </a>
                                            </div>
                                            <div class="card-vertical-product-price">
                                                @if($besteller->price == 0)
                                                    0 تومان
                                                    @if($besteller->quantity == 0 )
                                                        <span style="color: #d7bd3b;">ناموجود</span>
                                                    @endif
                                                @elseif(\App\Helper\Price::priceProdct($besteller->id ) == 1)
                                                    <span class="text-center font-size-14">{{number_format($besteller->price)}} </span>
                                                    <span class="toman">تومان</span>
                                                    @if($besteller->quantity == 0 )
                                                        <span style="color: #d7bd3b;">ناموجود</span>
                                                    @endif
                                                @else
                                                    <div>
                                                        <s class=" font-size-12">{{$besteller->price}} تومان</s>
                                                        <br>
                                                        @if($besteller->quantity == 0 )
                                                            <span>ناموجود</span>
                                                        @endif
                                                        <span class="new-price-discount" style="float: unset">%{{(1-\App\Helper\Price::priceProdct($besteller->id ))*100}}</span>
                                                        <span class="font-size-14"> {{number_format(\App\Helper\Price::priceProdct($besteller->id )*$besteller->price)}}</span>
                                                        <span class="toman">تومان</span>
                                                    </div>
                                                @endif
                                                <span class="price-currency"
                                                      wire:click.prevent="calculateRate({{$besteller->id}})"></span>
                                                <div class="stars-plp">
                                                    @for($i=1;$i<=5;$i++)
                                                        <span class="mdi mdi-star @if($i <= $this->calculateRate($besteller->id) ) active @endif"></span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="product-actions-secondary section-style">
                                                <div class="heart" title="افزودن به لیست علاقه مندی">
                                                    @if($this->isLike($besteller->id))
                                                        <span class="mdi mdi-heart heart-active"
                                                              wire:click.prevent="removeToWishlist({{$besteller->id}})"></span>
                                                    @else
                                                        <span class="mdi mdi-heart"
                                                              wire:click.prevent="addToWishlist({{$besteller->id}})"></span>
                                                    @endif
                                                </div>
                                                <a href="{{route('SingleProduct',$besteller->slug)}}"
                                                   class="product-introduction-cart" title=" مشاهده کالا">
                                                            <span class="c-introduction">
                                                               مشاهده کالا
                                                            </span>
                                                </a>
                                                <div class="comparison" title="افزودن برای مقایسه"
                                                     wire:click.prevent="compare({{$besteller->id}})">
                                                    <i class="fa fa-random" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </li>
                        <li wire:ignore.self class="item-content">
                            <a href="#" class="link-content"> </a>
                            @foreach($Newproducts as $Newproduct)

                                <div class="col-lg-3 col-md-4 col-xs-12 pull-right mb-3">
                                    <a href="#" class="link-content">
                                    </a>
                                    <div class="product-vertical">
                                        <a href="{{route('SingleProduct',$Newproduct->slug)}}" class="link-content">
                                        </a>
                                        <div class="vertical-product-thumb"><a
                                                    href="{{route('SingleProduct',$Newproduct->slug)}}"
                                                    class="link-content">
                                            </a><a href="{{route('SingleProduct',$Newproduct->slug)}}">
                                                <img src="/storage/{{$Newproduct->image}}" alt="{{$Newproduct->title}}">
                                            </a>
                                        </div>
                                        <div class="card-vertical-product-content">
                                            <div class="card-vertical-product-title">
                                                <a href="{{route('SingleProduct',$Newproduct->slug)}}">
                                                    {{$Newproduct->title}}
                                                </a>
                                            </div>
                                            <div class="card-vertical-product-price">
                                                @if($Newproduct->price == 0)
                                                    0 تومان
                                                    @if($Newproduct->quantity == 0 )
                                                        <span style="color: #d7bd3b;">ناموجود</span>
                                                    @endif
                                                @elseif(\App\Helper\Price::priceProdct($Newproduct->id ) == 1)
                                                    <span class="text-center font-size-14">{{number_format($Newproduct->price)}} </span>
                                                    <span class="toman">تومان</span>
                                                    @if($Newproduct->quantity == 0 )
                                                        <span style="color: #d7bd3b;">ناموجود</span>
                                                    @endif
                                                @else
                                                    <div>
                                                        <s class=" font-size-12">{{$Newproduct->price}} تومان</s>
                                                        <br>
                                                        @if($Newproduct->quantity == 0 )
                                                            <span>ناموجود</span>
                                                        @endif
                                                        <span class="new-price-discount" style="float: unset">%{{(1-\App\Helper\Price::priceProdct($Newproduct->id ))*100}}</span>
                                                        <span class="font-size-14"> {{number_format(\App\Helper\Price::priceProdct($Newproduct->id )*$Newproduct->price)}}</span>
                                                        <span class="toman">تومان</span>
                                                    </div>
                                                @endif
                                                <span class="price-currency"
                                                      wire:click.prevent="calculateRate({{$Newproduct->id}})"></span>
                                                <div class="stars-plp">
                                                    @for($i=1;$i<=5;$i++)
                                                        <span class="mdi mdi-star @if($i <= $this->calculateRate($Newproduct->id) ) active @endif"></span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="product-actions-secondary section-style">
                                                <div class="heart" title="افزودن به لیست علاقه مندی">
                                                    @if($this->isLike($Newproduct->id))
                                                        <span class="mdi mdi-heart heart-active"
                                                              wire:click.prevent="removeToWishlist({{$Newproduct->id}})"></span>
                                                    @else
                                                        <span class="mdi mdi-heart"
                                                              wire:click.prevent="addToWishlist({{$Newproduct->id}})"></span>
                                                    @endif
                                                </div>
                                                <a href="{{route('SingleProduct',$Newproduct->slug)}}"
                                                   class="product-introduction-cart" title=" مشاهده کالا">
                                                            <span class="c-introduction">
                                                               مشاهده کالا
                                                            </span>
                                                </a>
                                                <div class="comparison" title="افزودن برای مقایسه"
                                                     wire:click.prevent="compare({{$Newproduct->id}})">
                                                    <i class="fa fa-random" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </li>
                        <li wire:ignore.self class="item-content">
                            <a href="#" class="link-content"> </a>
                            @foreach($cheeps as $cheep)

                                <div class="col-lg-3 col-md-4 col-xs-12 pull-right mb-3">
                                    <a href="#" class="link-content">
                                    </a>
                                    <div class="product-vertical">
                                        <a href="{{route('SingleProduct',$cheep->slug)}}" class="link-content">
                                        </a>
                                        <div class="vertical-product-thumb"><a
                                                    href="{{route('SingleProduct',$cheep->slug)}}" class="link-content">
                                            </a><a href="{{route('SingleProduct',$cheep->slug)}}">
                                                <img src="/storage/{{$cheep->image}}" alt="{{$cheep->title}}">
                                            </a>
                                        </div>
                                        <div class="card-vertical-product-content">
                                            <div class="card-vertical-product-title">
                                                <a href="{{route('SingleProduct',$cheep->slug)}}">
                                                    {{$cheep->title}}
                                                </a>
                                            </div>
                                            <div class="card-vertical-product-price">
                                                @if($cheep->price == 0)
                                                    0 تومان
                                                    @if($cheep->quantity == 0 )
                                                        <span style="color: #d7bd3b;">ناموجود</span>
                                                    @endif
                                                @elseif(\App\Helper\Price::priceProdct($cheep->id ) == 1)
                                                    <span class="text-center font-size-14">{{number_format($cheep->price)}} </span>
                                                    <span class="toman">تومان</span>
                                                    @if($cheep->quantity == 0 )
                                                        <span style="color: #d7bd3b;">ناموجود</span>
                                                    @endif
                                                @else
                                                    <div>
                                                        <s class=" font-size-12">{{$cheep->price}} تومان</s>
                                                        <br>
                                                        @if($cheep->quantity == 0)
                                                            <span>ناموجود</span>
                                                        @endif
                                                        <span class="new-price-discount" style="float: unset">%{{(1-\App\Helper\Price::priceProdct($cheep->id ))*100}}</span>
                                                        <span class="font-size-14"> {{number_format(\App\Helper\Price::priceProdct($cheep->id )*$cheep->price)}}</span>
                                                        <span class="toman">تومان</span>
                                                    </div>
                                                @endif
                                                <span class="price-currency"
                                                      wire:click.prevent="calculateRate({{$cheep->id}})"></span>
                                                <div class="stars-plp">
                                                    @for($i=1;$i<=5;$i++)
                                                        <span class="mdi mdi-star @if($i <= $this->calculateRate($cheep->id) ) active @endif"></span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="product-actions-secondary section-style">
                                                <div class="heart" title="افزودن به لیست علاقه مندی">
                                                    @if($this->isLike($cheep->id))
                                                        <span class="mdi mdi-heart heart-active"
                                                              wire:click.prevent="removeToWishlist({{$cheep->id}})"></span>
                                                    @else
                                                        <span class="mdi mdi-heart"
                                                              wire:click.prevent="addToWishlist({{$cheep->id}})"></span>
                                                    @endif
                                                </div>
                                                <a href="{{route('SingleProduct',$cheep->slug)}}"
                                                   class="product-introduction-cart" title=" مشاهده کالا">
                                                            <span class="c-introduction">
                                                               مشاهده کالا
                                                            </span>
                                                </a>
                                                <div class="comparison" title="افزودن برای مقایسه"
                                                     wire:click.prevent="compare({{$cheep->id}})">
                                                    <i class="fa fa-random" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</div>
