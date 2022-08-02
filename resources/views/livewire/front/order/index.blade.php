<div>
    <div class="container-main">
        <div class="loading" wire:loading wire:target="copen">Loading&#8230;</div>
        <div class="col-12 mt-2 position-relative section-style">
            <div class="breadcrumb-container">
                <ul class="js-breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('Cart')}}" class="breadcrumb-link">سبد خرید</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('ShippingOrders')}}" class="breadcrumb-link">تسویه حساب</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="breadcrumb-link active-breadcrumb">پرداخت</a>
                    </li>
                </ul>
            </div>
        </div>
        <section class="page-shipping">
            <div class="page-row">
                <div class="col-lg-8 col-md-8 col-xs-12 pull-right">
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
                                        @if($shipping)
                                            @isset($siteOption->offline_pay)
                                                @if($siteOption->offline_pay==1)
                                                    <li>
                                                        <div class="payment-paymethod-item">
                                                            <label for="#" class="outline-radio">
                                                                <input id="offline" wire:model.defer="payment_method"
                                                                       value="offline" type="radio"
                                                                       name="payment_method" id="payment-option-online">
                                                                <span class="outline-radio-check"></span>
                                                            </label>
                                                            <label for="offline" class="payment-paymethod-title-row">
                                                                <div class="payment-paymethod-title">
                                                                    پرداخت موقع تحویل
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endisset
                                        @endif
                                    </ul>
                                </div>
                                <div class="shipment-page-container mt-2">
                                    <form id="shipping-data-form">
                                        @if($shipping)
                                            <div class="js-normal-delivery">
                                                <div class="checkout-pack">
                                                    <div class="checkout-pack-row js-shipment-submit-type">
                                                        <div class="checkout-time-table">
                                                            <span>انتخاب نحوه ارسال سفارش</span>
                                                            <hr>
                                                            @error('shipping_method')
                                                            <span style="color: red;font-size: 12px" class="is-invalid">لطفا نحوه ارسال سفارش را انتخاب کنید.</span><br>
                                                            @enderror
                                                            @foreach($post as $key => $item)
                                                                <div class="checkout-additional-options-action-bar">
                                                                    <div class="checkout-additional-options-checkbox-container">
                                                                        <input id="shipping_data_{{$key}}" type="radio"
                                                                               name="shipping_method"
                                                                               wire:model="shipping_method"
                                                                               wire:click="price_post({{ $item[0] }})"
                                                                               value="{{ $item[0] }}">
                                                                        <img src="/storage/{{  $item[2]  }}"
                                                                             for="shipping_data_{{$key}}"
                                                                             class="checkout-additional-options-checkbox-image">
                                                                    </div>
                                                                    <label style="display: inline-flex !important;"
                                                                           for="shipping_data_{{$key}}"
                                                                           class="checkout-additional-options-checkbox-image">
                                                                        <div class="checkout-additional-options-action-container">
                                                                            <div class="checkout-additional-options-action-title">
                                                                                پست {{ $item[1] }}
                                                                            </div>
                                                                            <div class="checkout-additional-options-action-lead-time">
                                                                                زمان تقریبی تحویل {{ $item[3] }} روز
                                                                            </div>
                                                                            <div class="checkout-additional-options-action-lead-time">
                                                                                هزینه ارسال {{ $item[0] }}
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                                <div class="payment-voucher">
                                    <div class="payment-voucher-header">
                                        <button class="btn btn-block text-right collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="false"
                                                aria-controls="collapseOne">
                                            کد تخفیف
                                            <i class="mdi mdi-chevron-down"></i>
                                            <div class="payment-voucher-header"></div>
                                        </button>
                                    </div>
                                    <div class="payment-gift-card-list">
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                             data-parent="#accordionExample" style="">
                                            <div class="payment-voucher-input-row">
                                                <label for="payment-voucher-input" class="payment-serial-input-label">کد
                                                    تخفیف</label>
                                                <div class="payment-serial-input-container">
                                                    <input wire:model.defer="copen" type="text"
                                                           class="payment-serial-input form-control"
                                                           id="payment-voucher-input" placeholder="افزودن کد تخفیف">
                                                    <button wire:click.prevent="AddCopen()"
                                                            class="payment-serial-button">اعمال
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="checkout-actions">
                            <a href="{{route('Cart')}}" class="checkout-actions-back"><i class="fa fa-angle-right"
                                                                                         aria-hidden="true"></i>بازگشت
                                به سبد خرید</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
                    <div class="page-aside">
                        <div class="checkout-aside">
                            <div class="checkout-bill">
                                <ul class="checkout-bill-summary">
                                    <li>
                                        <span class="checkout-bill-item-title">قیمت کالاها</span>
                                        <span class="checkout-bill-price">
                                           {{number_format($totalPrice)}}
                                            <span class="checkout-bill-currency">
                                                تومان
                                            </span>
                                        </span>
                                    </li>
                                    @if($cartDiscount >=1)
                                        <li>
                                            <span class="checkout-bill-item-title">تخفیف بر روی سبد خرید</span>
                                            <span class="checkout-bill-price">
                                           {{number_format($cartDiscount)}}
                                            <span class="checkout-bill-currency">
                                                تومان
                                            </span>
                                        </span>
                                        </li>
                                    @endif
                                    @if($code >=1)
                                        <li>
                                            <span class="checkout-bill-item-title">کوپن</span>
                                            <span class="checkout-bill-price">
                                           {{number_format($code)}}
                                            <span class="checkout-bill-currency">
                                                تومان
                                            </span>
                                        </span>
                                        </li>
                                    @endif
                                    @if($shipping)
                                        <li>
                                            <span class="checkout-bill-item-title">هزینه ارسال</span>
                                            <span class="checkout-bill-price">
                                           {{number_format($price_post)}}
                                            <span class="checkout-bill-currency">
                                                تومان
                                            </span>
                                        </span>
                                        </li>
                                    @endif
                                    <li class="checkout-bill-total-price">
                                        <span class="checkout-bill-total-price-title">مبلغ قابل پرداخت</span>
                                        <span class="checkout-bill-total-price-amount">
                                            <span class="js-price">{{number_format($totalPrice - $cartDiscount - $code + $price_post)}}</span>
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
        </section>
    </div>
</div>

