<div>
    <div class="loading" wire:loading wire:target="addToCart">Loading&#8230;</div>
    <div class="col-lg-8 col-xs-12 pull-right">
        <section class="product-info">
            <div class="product-headline">
                <h1 class="product-title">
                    {{$product->title}}
                    <span class="product-title-en">{{$product->slug}}</span>
                </h1>
            </div>
            <div class="product-attributes">

                <div class="col-lg-6 col-xs-12 pull-right">

                    <div class="product-config">
                        <div class="product-config-wrapper">

                            <div class="product-variants">
                                @foreach($options as $option)
                                    @if($option->required ==1)
                                        <span style="color:red">  *  </span>
                                    @endif
                                    <span>انتخاب {{$option->option}}: </span>
                                    @error("color.$option->id")
                                    <span style="color: red"> {{$message}}  </span>
                                    @enderror
                                    @if($option->type=='color'|| $option->type=='radio')
                                        <br>
                                        <ul class="js-product-variants">
                                            @foreach(\App\Models\Option::where('product_id',$this->product->id)->where('option',$option->option)->get() as $optionValue)
                                                <li  wire:ignore class="ui-variant send-count" wire:change="changePrie({{$optionValue->id}},{{$option->id}})">
                                                    <label for="#" class="ui-variant-color">
                                                        @if($option->type=='color')
                                                            <span class="ui-variant-shape" style="background-color: {{$optionValue->color}}"></span>
                                                         @endif
                                                        <input type="radio" wire:model.defer="color.{{$option->id}}" name="color.{{$option->id}}"  value="{{$optionValue->value}}"
                                                               class="js-variant-selector" checked="">
                                                        <span @if($option->type=='radio') style="padding-right: 5px !important;"  @endif class="ui-variant-check">{{$optionValue->value}} </span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @elseif($option->type=='select')
                                        <div  class="mt-2 mb-3">
                                        <select class="form-control send-count" wire:change='changeSelectPrice($event.target.value,{{$option->id}})' wire:model.defer="color.{{$option->id}}" wire:change="changePrie($event.target.value,{{$option->id}})">
                                            <option value="">لطفا انتخاب کنید</option>
                                            @foreach(\App\Models\Option::where('product_id',$this->product->id)->where('option',$option->option)->get() as $optionValue1)
                                                <option value="{{$optionValue1->value}}">{{$optionValue1->value}} </option>
                                            @endforeach
                                        </select>
                                        </div>
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
                                @if($product->quantity >= 1 || $product->type =='digital')
                                    <button id="cart" class="dk-btn dk-btn-info at-c as-c send-count"
                                            wire:click.prevent="addToCart({{$product->id}})">
                                        افزودن به سبد خرید
                                        <i class="mdi mdi-cart"></i>
                                    </button>
                                @else
                                    <button  class="dk-btn dk-btn-info product-stock-action" wire:click.prevent="NoProduct()">
                                       موجود شد به من خبر بده
                                        <i class="fa fa-bell"></i>
                                    </button>
                                @endif
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
    <div class="modal" wire:ignore.self id="form1"  style="display: none; padding-right: 17px;" aria-modal="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo " style="border-radius:5px">
                <div class="modal-header border-bottom-0">
                    <h6 class="modal-title">ثبت اطلاعات در لیست</h6>
                    <button aria-label="بستن" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">×</span></button>
                </div>
                <hr>
                <div class="modal-body" style="padding: 0 !important;">
                    <div class="container">
                    <div class="middle-container ">
                        <form  class="form-checkout" wire:submit.prevent="NoLogin()">
                            <div class="form-checkout-row">
                                <label for="name">ایمیل<span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="email" type="text" id="name" class="input-name-checkout form-control @error('email') is-invalid @enderror" placeholder="آدرس ایمیل">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="phone-number">شماره موبایل <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="phone" type="text" id="phone-number" class="input-name-checkout form-control @error('phone') is-invalid @enderror" placeholder="09xxxxxxxxx" style="text-align:left;">
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                <div class="AR-CR">
                                    <button class="btn-registrar">
                                        <span>ذخیره</span>
                                    </button>
                                    <a href="#" class="cancel-edit-address" data-dismiss="modal" aria-label="Close">انصراف و بازگشت</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('jsBeforMain')
    <script>
        $('.send-count').on('click', function () {
            var x = document.getElementById("countProduct").value;
            @this.set('count', x);
        })
    </script>
    <script>
        $(document).ready(function () {
            window.addEventListener('hide-form1', event => {
                $('#form1').modal('hide');
            })
            window.addEventListener('show-form1', event => {
                $('#form1').modal('show');
            })


        });

    </script>

@endpush
