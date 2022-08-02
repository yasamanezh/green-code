<div class="container-main" id="search-page" wire:init="isReady()">
    <div class="loading" wire:loading wire:target="sortBy">Loading&#8230;</div>
    <div class="col-12">
        <div class="breadcrumb-container mt-2">
            <ul class="js-breadcrumb">
                <li class="breadcrumb-item"> <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a> </li>
                <li class="breadcrumb-item"> <a href="" class="breadcrumb-link active-breadcrumb">{{$brand->title}}</a>  </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 pull-left">
        <div class="page-contents">
            <article class="listing-wrapper-tab category">
                <div class="listing">
                    <div class="listing-header">
                        <div class="listing-sort-option-header">
                            <span class="font14 hidden-xs hidden-sm">
                                <i class="fa fa-list" id="listicon"></i>
                                مرتب سازی بر اساس :

                            </span>

                            <ul class="sort-options">
                                <li class="listing-active" wire:ignore wire:click="sortBy('countsell','DESC')">
                                    <a class="listing-tab-item">پرفروش‌ترین‌</a>
                                </li>
                                <li wire:ignore wire:click="sortBy('id','DESC')">
                                    <a class="listing-tab-item">جدیدترین</a>
                                </li>
                                <li wire:ignore wire:click="sortBy('price','ASC')">
                                    <a class="listing-tab-item">ارزان‌ترین</a>
                                </li>
                                <li wire:ignore wire:click="sortBy('price','DESC')">
                                    <a class="listing-tab-item">گران‌ترین</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="listing-items">
                        @if(count($products) >=1)
                        @foreach($products as $product)
                            <div class="col-lg-3 col-md-4  col-sm-6  col-xs-12 pull-right mb-3">
                                <div class="product-vertical">
                                    <div class="vertical-product-thumb text-center">
                                        <a >
                                            <div class="stars-plp">
                                                @for($i=1;$i<=5;$i++)
                                                    <span class="mdi mdi-star @if($i <= $this->calculateRate($product->id) ) active @endif"></span>
                                                @endfor
                                            </div>
                                        </a>
                                        <a href="{{route('SingleProduct',$product->slug)}}">
                                            <img class="img-fluid" src="/storage/{{$product->image}}">
                                        </a>
                                    </div>
                                    <div class="card-vertical-product-content">
                                        <div class="card-vertical-product-title">
                                            <a href="{{route('SingleProduct',$product->slug)}}">
                                                {{ $product->title}}
                                            </a>
                                        </div>

                                        <div class="card-vertical-product-price text-center">
                                            @if($product->price ==0)
                                                {{number_format($product->price)}}  تومان
                                                @if($product->quantity == 0 )
                                                    <span>ناموجود</span>
                                                @endif
                                            @else
                                                @if(\App\Helper\Price::priceProdct($product->id ) == 1)
                                                    <span class="text-center font-size-14">{{number_format($product->price)}} </span><span class="toman">تومان</span>
                                                    @if($product->quantity == 0 )
                                                        <span>ناموجود</span>
                                                    @endif
                                                @else
                                                    <div class="text-center">
                                                        <s class=" font-size-12">{{number_format($product->price)}} تومان</s>
                                                        <br>
                                                        @if($product->quantity == 0 )
                                                            <span>ناموجود</span>
                                                        @endif
                                                        <span class="new-price-discount" style="float: unset">%{{(1-\App\Helper\Price::priceProdct($product->id ))*100}}</span>
                                                        <span class="font-size-14"> {{number_format(\App\Helper\Price::priceProdct($product->id )*$product->price)}}</span>
                                                        <span class="toman">تومان</span>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                            @else
                                <div class="container">
                                    <div class="alert alert-danger">
                                        <p> موردی یافت نشد</p>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>
            </article>
        </div>
        @if($readyToLoad)
            <div class="position-relative pull-left mt-2">{{$products->links()}}</div>
        @endif
    </div>
</div>
<!--search------------------------------------->

