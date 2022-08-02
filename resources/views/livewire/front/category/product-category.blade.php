<div>
    <div class="container-main">
    <div class="loading" wire:loading wire:target="categoryFilter">Loading&#8230;</div>
    <div class="loading" wire:loading wire:target="propertyFilter">Loading&#8230;</div>
    <div class="loading" wire:loading wire:target="sortBy">Loading&#8230;</div>
    <div class="loading" wire:loading wire:target="quality">Loading&#8230;</div>
    <div class="col-12">
        <div class="breadcrumb-container mt-2">
            <ul class="js-breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                </li>
                @if($child)
                    <li class="breadcrumb-item">
                        <a href="{{route('ProductCategory',$child->slug)}}"
                           class="breadcrumb-link">{{$child->title}}</a>
                    </li>
                @endif
                @if($sub)
                    <li class="breadcrumb-item">
                        <a href="{{route('ProductCategory',$sub->slug)}}" class="breadcrumb-link">{{$sub->title}}</a>
                    </li>
                @endif
                <li class="breadcrumb-item ">
                    <a href="{{route('ProductCategory',$category->slug)}}"
                       class="breadcrumb-link active-breadcrumb">{{$category->title}}</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-xs-12 pull-right">
        <section class="page-aside">
            <div class="sidebar-wrapper">
                <div class="listing-sidebar mb-4">
                    <div class="box-header-product-feature mb-3">
                        <span class="title-product">فیلتر محصولات</span>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <span class="title-header">جستجو</span>
                        </div>
                        <div class="box-content">
                            <div class="ui-input-quick-search">
                                <input wire:model.lazy="search" type="text" name="searchInput"
                                       class="input-field-cleanable"
                                       placeholder="جستجو …">
                                <button class="btn-search-cleanable">
                                    <img src="{{asset('assets/images/search.png')}}">
                                </button>
                            </div>
                        </div>
                    </div>
                    @if(\App\Models\Category::where('parent',$category->id)->first())
                    <div class="box">
                        <div class="box-header">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-right" data-toggle="collapse" href="#collapseExample"
                                        role="button" aria-expanded="false" aria-controls="collapseExample">
                                    دسته بندی
                                    <i class="mdi mdi-chevron-down"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseExample" >
                            <div class="card-main mb-3">
                                @if($category)
                                    @foreach(\App\Models\Category::where('parent',$category->id)->get() as $keyCategory=>$value)

                                        <div class="form-auth-row" >
                                            <label for="#" class="ui-checkbox "
                                                   wire:change="categoryFilter({{$value->id}})">
                                                <input type="checkbox" wire:model="categoryKey.{{$value->id}}"
                                                       value="1" name="login" id="remember">
                                                <span class="ui-checkbox-check"></span>
                                            </label>
                                            <label for="remember"
                                                   class="remember-me">{{\App\Models\Category::where('id',$value->id)->pluck('title')->first()}}</label>
                                        </div>
                                        @foreach(\App\Models\Category::where('parent',$value->id)->get() as $keyCategory1=>$value1)

                                            <div class="form-auth-row" style="margin-right:30px">
                                                <label for="#" class="ui-checkbox "
                                                       wire:change="categoryFilter({{$value1->id}})">
                                                    <input type="checkbox" wire:model="categoryKey.{{$value1->id}}"
                                                           value="1" name="login" id="remember">
                                                    <span class="ui-checkbox-check"></span>
                                                </label>
                                                <label for="remember"  class="remember-me">{{\App\Models\Category::where('id',$value1->id)->pluck('title')->first()}}</label>
                                            </div>
                                        @endforeach
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @foreach($filters  as $key=>$filter)
                        <div class="box">
                            <div class="box-header">
                                <h2 class="mb-0">
                                    <button wire:ignore class="btn btn-block text-right" data-toggle="collapse"
                                            href="#collapseExample{{$filter->id}}" role="button"
                                            aria-expanded="false" aria-controls="collapseExample{{$filter->id}}">
                                        {{$filter->title}}
                                        <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                </h2>
                            </div>
                            <div wire:ignore.self id="collapseExample{{$filter->id}}" class="collapse">
                                <div class="card-main mb-3">
                                    @foreach(explode(',',$filter->attribute_id) as $keyfilter=>$value)
                                        <div class="form-auth-row">
                                            <label wire:change="propertyFilter({{$filter->id}},{{$value}},{{$keyfilter}})"
                                                   class="ui-checkbox">
                                                <input wire:model="filterKey.{{$key}}.{{$keyfilter}}"
                                                       type="checkbox" value="1" name="login" id="remember">
                                                <span class="ui-checkbox-check"></span>
                                            </label>
                                            <label for="remember" class="remember-me">{{$value}}</label>
                                            {{\App\Models\Attribute::where('title',$filter->title)->where('category_id',$category->id)->pluck('value')->first()}}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @endforeach
                    @once
                        <div class="box" >
                            <div class="box-header">
                                <h2 class="mb-0">
                                    <button wire:ignore  class="btn btn-block text-right collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                        محدوده قیمت
                                        <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                </h2>
                            </div>
                            <div wire:ignore.self id="collapseFive" class="collapse show" aria-labelledby="headingFive"
                                 data-parent="#collapseFive" style="">
                                <div class="card-main mt-3">
                                    <div class="box-data mb-4">
                                        <form action="">
                                            <div class="filter-range mt-2 mb-2">
                                                <span>قیمت: </span>
                                                <span wire:ignore class="text-info"> {{$max_price}} - {{$min_price}} </span>
                                                <div id="slider-non-linear-step-value" class="example-val" wire:ignore></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endonce
                    <div class="box">
                        <div class="statusswitcher">
                            <a >
                                <label for="switch1">
                                    <input type="checkbox" wire:model="quality" id="switch1"><span class="switch"><h1 class="switch-title">فقط کالای موجود</h1></span>
                                    <span class="toggle"></span>
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-9 col-md-8 col-xs-12 pull-left">
        <div class="page-contents">
            <article class="listing-wrapper-tab category">
                <div class="listing">
                    <div class="listing-header">
                        <div class="listing-sort-option-header">
                            <span class="font14 hidden-xs hidden-sm ">
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
                                <div class="col-lg-4 col-md-6 col-sm-6  col-xs-12 pull-right mb-3">
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
                                                        <span class="text-center font-size-14">
                                                        {{number_format($product->price)}} </span>
                                                        <span class="toman">تومان</span>
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

        <div class="position-relative pull-left">{{$products->links()}}</div>


    </div>

</div>
@once
    @push('jsBeforMain')

        <script>
            $(document).ready(function () {
                var slider = document.getElementById('slider-non-linear-step-value');

                noUiSlider.create(slider, {
                    start: [{{$min_price}}, {{$max_price}}],
                    connect: true,
                    range: {
                        'min': {{$min_price}},
                        'max': {{$max_price}}
                    },
                    pips: {
                        mode: 'steps',
                        stepped: true,
                        density: 4
                    }
                });

                slider.noUiSlider.on('update', function (value) {
                @this.
                set('min_price', value[0]);
                @this.
                set('max_price', value[1]);
                });
            });

        </script>

        @endpush
@endonce
        </div>
