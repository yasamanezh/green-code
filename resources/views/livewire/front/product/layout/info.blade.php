<div>

    <section class="product-info">
        <div class="product-headline">
            <h1 class="product-title">
                <span class="product-title-en">{{$product->title}}</span>
            </h1>
        </div>
        <div class="product-attributes">

            <div class="col-lg-6 col-xs-12 pull-right">

                <div >
                    <div >

                        <div >
                            @foreach($options as $option)
                                @if($option->required ==1)
                                    <span style="color:red">  *  </span>
                                @endif
                                <span>انتخاب {{$option->option}}: </span>
                                @error("color.$option->id")
                                <span style="color: red"> {{$message}}  </span>
                                @enderror
                                @if($option->type=='select' || $option->type=='color'|| $option->type=='radio' )
                                    <div  class="mt-2 mb-3">
                                        <select class="form-control" wire:change='changeSelectPrice($event.target.value,{{$option->id}})' wire:model.defer="color.{{$option->id}}" wire:change="changePrie($event.target.value,{{$option->id}})">
                                            <option value="">لطفا انتخاب کنید</option>
                                            @foreach(\App\Models\Option::where('product_id',$this->product->id)->where('option',$option->option)->get() as $optionValue1)
                                                <option value="{{$optionValue1->value}}">{{$optionValue1->value}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @elseif($option->type=='input')
                                        <form >
                                            <input class="form-control"  wire:model.defer="color.{{$option->id}}" >
                                        </form>
                                @endif
                            @endforeach

                        </div>


                        <div class="product-params">
                            <ul>ویژگی‌های محصول
                                @php $i=1; @endphp
                                @foreach($product->productAtts as $value)

                                    <li class="@if($i>=4) product-params-more @endif ">
                                        <span>{{$value->attribue_description}}</span>

                                    </li>
                                    @php $i++; @endphp
                                @endforeach
                                <li class="product-params-more-handler">
                                    <a href="#" class="more-attr-button">
                                        <span class="show-more">+ موارد بیشتر</span>
                                        <span class="show-less">- بستن</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xs-12 pull-left">
                <div class="product-summary">
                    <div class="product-seller-info">
                        @isset($product->warrenty)
                            <div class="product-seller-row guarantee">
                                <span class="title"> گارانتی:</span>
                                <a  class="product-name">{{\App\Models\Warranty::where('id',$product->warrenty)->pluck('name')->first()}}</a>
                            </div>
                        @endisset
                        @isset($manufacturer->title)
                            <div class="product-seller-row guarantee">

                                <span class="title"> برند:</span>

                                <a href="#" class="product-name">{{$manufacturer->title}}</a>
                            </div>
                        @endisset
                        @if($product->type == 'phisical' && $product->quantity !=0 && $product->quantity <= 3  )
                            <div class="product-seller-row guarantee">
                                <a href="#"> فقط تعداد {{$product->quantity}} عدد از این کالا موجود است.</a>
                            </div>
                        @endif

                        <div class="product-seller-row price">
                                <span class="product-seller-price-info price-value mb-3">
                                    <span class="title"> قیمت:</span>
                                    <span class="amount">
                                        @if($product->price == 0)
                                            0 تومان
                                        @elseif($percent >=1)
                                            <s class=" font-size-12">{{$product->price}} تومان</s>
                                            <br>

                                            <span class="new-price-discount ">%{{$percent}}</span>
                                            <span class="font-size-14"> {{number_format($price*(1-($percent/100))+$optionPrices)}} </span>
                                            <span class="toman">تومان</span>
                                        @else
                                            <span class="text-center font-size-14">{{number_format($price+$optionPrices)}} </span><span class="toman">تومان</span>
                                        @endif

                                    </span>
                                </span>
                        </div>
                        <div class="product-seller-row guarantee">
                            <span class="title mt-3"> تعداد:</span>
                            <div class="quantity pl" wire:ignore>
                                <input wire:ignore disabled id="countProduct"  wire:model.lazy="count" type="number" min="1" step="1" value="1">
                                <div class="quantity-nav">
                                    <div class="quantity-button quantity-up cart">+</div>
                                    <div class="quantity-button quantity-down cart">-</div>
                                </div>
                                <div class="quantity-nav">
                                    <div class="quantity-button quantity-up cart">+</div>
                                    <div class="quantity-button quantity-down cart">-</div>
                                </div>
                            </div>

                            @error('count')
                            <span style="color: red;display: block">
                                   {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="parent-btn">
                              <button id="cart" class="dk-btn dk-btn-info at-c as-c send-count"
                                        wire:click.prevent="addToCart({{$product->id}})">
                                    افزودن به سبد خرید
                                    <i class="mdi mdi-cart"></i>
                                </button>

                        </div>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
