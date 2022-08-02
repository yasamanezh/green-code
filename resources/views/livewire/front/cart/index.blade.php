<div>
    <div class="container-main">
        <div class="col-12">
            <div class="breadcrumb-container mt-2">
                <ul class="js-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="" class="breadcrumb-link active-breadcrumb">سبد خرید</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="page-content">
            @if(count($carts) >=1)

            <div class="cart-main">
                <div class="col-lg-9 col-md-9 col-xs-12 pull-right">
                    @include('livewire.front.layouts.message')
                    <div class="title-content">
                        <ul class="title-ul">
                            <li class="title-item product-name">
                                نام کالا
                            </li>
                            <li class="title-item required-number">
                                تعداد مورد نیاز
                            </li>
                            <li class="title-item unit-price">
                                قیمت واحد
                            </li>
                            <li class="title-item total">
                                مجموع
                            </li>
                        </ul>
                    </div>

                    @foreach($carts as $key=>$value)
                    <div class="page-content-cart">
                        <div class="checkout-body">
                            <div class="product-name before">
                                <a href="" class="remove-from-cart"  wire:click.prevent="removeFromCart({{$value->id}})">
                                    <i  class="fa fa-trash"></i>
                                </a>
                                <a  href="{{route('SingleProduct',\App\Models\Product::where('id',$value->product_id)->pluck('slug')->first())}}" class="col-thumb">
                                    <img src="/storage/{{\App\Models\Product::where('id',$value->product_id)->pluck('image')->first()}}">
                                </a>
                                <div class="checkout-col-desc">
                                    <a href="{{route('SingleProduct',\App\Models\Product::where('id',$value->product_id)->pluck('slug')->first())}}">
                                        <h1>
                                            {{\App\Models\Product::where('id',$value->product_id)->pluck('title')->first()}}
                                        </h1>
                                    </a>
                                    <div class="checkout-variant-color">
                                        @foreach($value->cartOptions as $option)
                                            <div class="checkout-guarantee"><i class="fa fa-check"></i>{{$option->value}}</div>
                                            {{$option->count}}
                                            @if(isset($option->count))
                                                {{$option->count}}
                                            @else

                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <br>

                                <span class="text-danger font-size-12">
                                    @if($this->isSetRequired($value->id))
                                        یکی از گزینه های ضروری این محصول را انتخاب نکرده اید.
                                    @endif

                                    @if($this->isProductExit($value->id)[0] == 2 )
                                        این محصول موجود نمیباشد لطفا سبد خرید خود را به روز رسانی کنید.
                                    @elseif($this->isProductExit($value->id)[0] == 4 )
                                        این محصول  با {{ $this->isProductExit($value->id)[1] }}موجود نمیباشد لطفا سبد خرید خود را به روز رسانی کنید.

                                    @elseif($this->isProductExit($value->id)[0] == 0)
                                        حداکثر موجودی قابل سفارش این محصول {{$this->isProductExit($value->id)[1]}}
                                        عدد می باشد.
                                   لطفا سبد خرید خود را به روز رسانی کنید.
                                    @elseif($this->isProductExit($value->id)[0] == 1)
                                        @if($this->isProductExit($value->id)[1] <=3)
                                            حداکثر موجودی این محصول{{$this->isProductExit($value->id)[1]}}
                                            عدد می باشد.
                                        @endif
                                    @endif
                                </span>
                            </div>

                            <div class="required-number before">
                                <div style="margin: 70px 20px"  >
                                    <div style="position: absolute" wire:loading
                                         wire:target="validateCount({{$value->id}})"
                                         class="spinner-grow text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <div class="quantity">
                                        <input type="number" disabled id="countProduct{{$value->id}}" wire:model.defer="countProduct.{{$value->id}}" min="1"  step="1" value="1">
                                        <div class="quantity-nav "  >
                                            <div class="send-count{{$value->id}}"  wire:click.prevent="validateCount({{$value->id}})">
                                                <div class="quantity-button quantity-up">+</div>
                                            </div>
                                            <div class="send-count{{$value->id}}"  wire:click.prevent="validateCount({{$value->id}})">

                                            <div class="quantity-button quantity-down" >-</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group btn-block" style="max-width: 200px;">

                                        @push('jsBeforMain')
                                            <script>
                                                $(".send-count{{$value->id}}").on('click', function () {
                                                    var x = document.getElementById("countProduct{{$value->id}}").value;
                                                @this.set('countProduct.{{$value->id}}', x);
                                                })
                                            </script>
                                        @endpush
                                    </div>
                                    @error("countProduct.$value->id")
                                    <p style="color: red;font-size: 9px;line-height:1">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="unit-price before">
                                <div class="product-price">
                                    {{number_format($price[$value->id])}}
                                    <span>
                                            تومان
                                        </span>
                                </div>
                            </div>
                            <div class="total before">
                                <div class="product-price">

                                    {{number_format( $price[$value->id]*$value->count)}}

                                   <span>  تومان  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12 pull-left">
                    <div class="page-aside">

                        <div class="checkout-summary">
                            <div class="comment-summary mb-3">
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم ی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                            </div>
                            <div class="discount-code mb-4">
                            <div class="amount-of-payable  mt-4">
                                <span class="payable">تخفیف روی سبد خرید</span>
                                <span class="amount-of">{{number_format($cartDiscount)}}
                                        <span>تومان</span>
                                </span>
                                <br>
                                <span class="payable">مبلغ قابل پرداخت</span>

                                <span class="amount-of">{{number_format($total-$cartDiscount)}}
                                        <span>تومان</span>
                                </span>
                                <a>
                                    @if($this->isDisable() == '1')
                                    <button class="setlement-account"  >
                                        تسویه حساب
                                    </button>
                                    @else
                                        <button class="setlement-account" wire:click.prevent="validateAllCount()"  >
                                            تسویه حساب
                                        </button>
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @else
                <div class="cart-page">
                    <div class="container">
                        <div class="checkout-empty">
                            <div class="checkout-empty-empty-cart-icon"></div>
                            <div class="checkout-empty-title">سبد خرید شما خالی است!</div>
                            <div class="col-lg-6 col-md-6!important col-xs-12 mx-auto">
                                <div class="checkout-empty-links">

                                    <p>
                                        می‌توانید برای مشاهده محصولات بیشتر به صفحه اصلی بروید
                                    </p>
                                    <div class="">
                                        <a href="{{route('Home')}}">
                                            صفحه اصلی
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    </div>
</div>
</div>
