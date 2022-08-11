<div>
    <div class="loading" wire:loading wire:target="copen">Loading&#8230;</div>
    <div class="container-xxl position-relative p-0" style="margin-top: -400px">

        <div class="container-xxl py-5 bg-primary hero-header mb-5">
            <div class="container my-5 py-2 px-lg-5">
                <div class="row g-5 py-2">
                    <div class="col-lg-6 text-center text-lg-start">
                        <img class="img-fluid" src="http://green-code.test/storage/photos/2/hero.png" alt="">
                    </div>

                    <div class="col-lg-6 text-center text-lg-start  mt-5" style="margin-top: 150px !important;">
                        <h1 class="text-white animated zoomIn text-center ">پرداخت</h1>
                        <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Home')}}">خانه</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">پرداخت</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl">
        <div class="container px-lg-5">
            <div class="row g-5">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="shipment-page-container">
                        <section class="page-content">
                            <div class="payment">
                                <div class="payment-payment-types">
                                    <div class="payment-header">
                                        <span>
                                            شیوه پرداخت
                                        </span>
                                    </div>
                                    @error('payment_method')
                                    <span style="color: red;font-size: 12px" class="is-invalid">لطفا روش پرداخت سفارش را انتخاب کنید.</span><br>
                                    @enderror
                                    <ul class="payment-paymethod">
                                        @isset($siteOption->saderat_status )
                                            @if($siteOption->saderat_status==1)
                                                <li>
                                                    <div class="payment-paymethod-item">
                                                        <label for="#" class="outline-radio">
                                                            <input id="sepehr" wire:model.defer="payment_method"
                                                                   value="sepehr" type="radio" name="payment_method"
                                                                   id="payment-option-online" checked="checked">
                                                            <span class="outline-radio-check"></span>
                                                        </label>
                                                        <label for="sepehr" class="payment-paymethod-title-row">
                                                            <div class="payment-paymethod-title">بانک صادرات</div>
                                                        </label>
                                                    </div>
                                                </li>

                                            @endif
                                        @endisset
                                        @isset($siteOption->meli_status)
                                            @if($siteOption->meli_status==1)
                                                <li>
                                                    <div class="payment-paymethod-item">
                                                        <label for="#" class="outline-radio">
                                                            <input id="sadad" wire:model.defer="payment_method"
                                                                   value="sadad" type="radio" name="payment_method"
                                                                   id="payment-option-online" checked="checked">
                                                            <span class="outline-radio-check"></span>
                                                        </label>
                                                        <label for="sadad" class="payment-paymethod-title-row">
                                                            <div class="payment-paymethod-title"> بانک ملی</div>
                                                        </label>
                                                    </div>
                                                </li>
                                            @endisset
                                        @endif
                                        @isset($siteOption->zarrinpall_status)
                                            @if($siteOption->zarrinpall_status ==1)
                                                <li>
                                                    <div class="payment-paymethod-item">
                                                        <label for="#" class="outline-radio">
                                                            <input id="zarinpal" wire:model.defer="payment_method"
                                                                   value="zarinpal" type="radio" name="payment_method"
                                                                   id="payment-option-online">
                                                            <span class="outline-radio-check"></span>
                                                        </label>
                                                        <label for="zarinpal" class="payment-paymethod-title-row">
                                                            <div class="payment-paymethod-title">زرین پال</div>
                                                        </label>
                                                    </div>
                                                </li>
                                            @endisset
                                        @endif
                                    </ul>
                                </div>


                            </div>
                        </section>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-aside">
                        <div class="checkout-aside">
                            <div class="checkout-bill">
                                <ul class="checkout-bill-summary">
                                    <li>
                                        <span class="checkout-bill-item-title">قیمت پکیج</span>
                                        <span class="checkout-bill-price">
                                           {{number_format($totalPrice)}}
                                            <span class="checkout-bill-currency">
                                                تومان
                                            </span>
                                        </span>
                                    </li>
                                    @if($cartDiscount >=1)
                                        <li>
                                            <span class="checkout-bill-item-title">تخفیف بر روی سفارش</span>
                                            <span class="checkout-bill-price">
                                           {{number_format($cartDiscount)}}
                                            <span class="checkout-bill-currency">
                                                تومان
                                            </span>
                                        </span>
                                        </li>
                                    @endif


                                    <li class="checkout-bill-total-price">
                                        <span class="checkout-bill-total-price-title">مبلغ قابل پرداخت</span>
                                        <span class="checkout-bill-total-price-amount">
                                            <span class="js-price">{{number_format($totalPrice - $cartDiscount  )}}</span>
                                            <span class="checkout-bill-total-price-currency">تومان</span>
                                        </span>
                                        <div class="parent-btn">
                                            <button class="dk-btn dk-btn-info payment-link"
                                                    wire:click.prevent="SaveOrder()">
                                                پرداخت
                                                <i class="mdi mdi-arrow-left"></i>
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

