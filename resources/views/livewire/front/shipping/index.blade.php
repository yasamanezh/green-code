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
                    <a href="#" class="breadcrumb-link active-breadcrumb">تسویه حساب</a>
                </li>
            </ul>
        </div>
    </div>
        <div class="cart-main">
            <div class="col-lg-8 col-md-8 col-xs-12 pull-right">
                <div class="shipment-page-container">
                    @if($shipping)
                        <div class="address-section">

                            <div class="checkout-contact">
                                <div class="checkout-contact-content">
                                    <span>انتخاب آدرس تحویل سفارش</span>
                                    <hr>
                                    @error('addres')
                                    <span style="color: red;font-size: 12px" class="is-invalid">لطفا آدرس  تحویل مرسوله را انتخاب کنید.</span><br>
                                    @enderror
                                    @foreach($addresses as $address)
                                        <input type="radio" wire:model.defer="addres" name="address"
                                               value="{{$address->id}}" id="address{{$address->id}}">
                                        <label for="address{{$address->id}}">
                                            <ul  class="checkout-contact-items" style="display:inline-block;">
                                                <li class="checkout-contact-item checkout-contact-item-username"> گیرنده :
                                                    <span class="js-recipient-full-name">{{$address->name}}</span>

                                                    <a wire:ignore href="#" wire:click.prevent="editAdress({{ $address->id }})"
                                                       class="checkout-contact-edit">اصلاح این آدرس</a>
                                                </li>
                                                <li class="checkout-contact-item checkout-contact-item-location">
                                                    <div class="checkout-contact-item checkout-contact-item-mobile">
                                                        شماره تماس :
                                                        <span class="js-recipient-mobile-phone"
                                                              data-value="09919140356">{{$address->mobile}}</span>
                                                    </div>
                                                    <div class="checkout-contact-item-message">
                                                        کد پستی :
                                                        <span class="js-recipient-post_code"
                                                              data-value="99999999999">{{$address->code_posti}}</span>
                                                    </div>
                                                    <br>
                                                    <span class="js-recipient-address-part">
                                            {{\App\Models\Country::where('id',$address->state)->pluck('name')->first()}} -
                                            {{\App\Models\City::where('id',$address->city)->pluck('name')->first()}} -
                                                {{$address->address}}

                                            </span>
                                                </li>
                                            </ul>
                                        </label><hr>
                                    @endforeach
                                    <br>
                                    <div wire:ignore >
                                        <button wire:click.prevent="AddAddress" class="checkout-contact-location"
                                                data-toggle="modal" data-target="#exampleModalCenter">افزودن آدرس
                                        </button>
                                    </div>

                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    @endif
                        <div class="address-section">
                            <div class="checkout-contact">
                                <div class="checkout-contact-content">
                                    <span>توضیحات سفارش</span>
                                    <hr>
                                    <div class="checkout-body" style="padding: 0px 5px">
                                        <section class="section-right">
                                            <div id="coupon_voucher_reward">
                                                <div class="checkout-content coupon-voucher">
                                                    <div>
                                                        <div class="panel-body checkout-coupon">
                                                            <div class="payment-serial-input-container">
                                                                    <textarea wire:model.defer="description" rows="5"  type="text"
                                                                              class="payment-serial-input form-control" id="payment-voucher-input" placeholder=" توضیحات خود را بنویسید."> </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="checkout-actions">
                        <a href="{{route('Cart')}}" class="checkout-actions-back"><i class="fa fa-angle-right" aria-hidden="true"></i>بازگشت
                            به سبد خرید</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-xs-12 pull-left" >
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
                                <li>
                                    <span class="checkout-bill-item-title">تخفیف </span>
                                    <span class="checkout-bill-item-title js-free-shipping">{{number_format($cartDiscount)}}
                                    <span class="checkout-bill-currency">
                                                تومان
                                            </span>
                                    </span>
                                </li>
                                <li class="checkout-bill-total-price">
                                    <span class="checkout-bill-total-price-title">مبلغ قابل پرداخت</span>
                                    <span class="checkout-bill-total-price-amount">
                                            <span class="js-price">{{number_format($totalPrice -$cartDiscount )}}</span>
                                            <span class="checkout-bill-total-price-currency">تومان</span>
                                        </span>
                                    <div class="parent-btn">
                                        <button class="dk-btn dk-btn-info payment-link"  wire:click.prevent="saveOrder">
                                            ادامه فرآیند خرید
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
<!-- Modal -->
    <div  wire:ignore.self class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        @if($showEditModal)
                            <span>ویرایش آدرس</span>
                        @else
                            <span>اضافه کردن آدرس جدید</span>
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="middle-container">
                        <form action="#" class="form-checkout" wire:submit.prevent="{{ $showEditModal ? 'updateAddress' : 'createAddress' }}">
                            <div class="form-checkout-row">
                                <label for="name">نام تحویل گیرنده <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="name" type="text" id="name" class="input-name-checkout form-control @error('name') is-invalid @enderror" placeholder="نام تحویل گیرنده را وارد نمایید">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="phone-number">شماره موبایل <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="mobile" type="text" id="phone-number" class="input-name-checkout form-control @error('mobile') is-invalid @enderror" placeholder="09xxxxxxxxx" style="text-align:left;">
                                @error('mobile')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div  class="form-checkout-valid-row">
                                    <label for="province">استان <span class="required-star"  style="color:red;"></span></label>
                                    <select wire:model="state" name="" id="province" class="form-control">
                                        <option value="date-desc" selected="selected">استان مورد نظر خود را انتخاب کنید
                                        </option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div  class="form-checkout-valid-row">
                                    <label for="city">شهر
                                        <span class="required-star" style="color:red;">*</span></label>
                                    <select wire:model.defer="city" name="" id="city" class="form-control">
                                        <option value="date-desc" selected="selected">شهر مورد نظر خود را انتخاب کنید</option>
                                        @if($state)
                                            @foreach(\App\Models\City::where('country_id',$state)->get() as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @error('city')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <label for="post-code">کد پستی<span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="code_posti" type="text" id="post-code" class="input-name-checkout form-control  @error('code_posti') is-invalid @enderror" placeholder="کد پستی را بدون خط تیره بنویسید">
                                @error('code_posti')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="address">آدرس
                                    <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="address" type="text" id="address" class="input-name-checkout form-control  @error('address') is-invalid @enderror" placeholder="آدرس خود را وارد نمایید" style="height:80px;">
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="AR-CR">
                                    <button class="btn-registrar">
                                        @if($showEditModal)
                                            <span>ذخیره تغییرات</span>
                                        @else
                                            <span>ذخیره</span>
                                        @endif</button>
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
    @push('jsPanel')
        <script>
            $(document).ready(function () {
                toastr.options = {
                    "positionClass": "toast-bottom-right",
                    "progressBar": true,
                }
                window.addEventListener('hide-form', event => {
                    $('#form').modal('hide');
                    toastr.success(event.detail.message, 'Success!');
                })
            });
            window.addEventListener('hide-form', event => {
                $('#form').modal('hide');
            })
            window.addEventListener('show-form', event => {
                $('#form').modal('show');
            })
            window.addEventListener('show-delete-modal', event => {
                $('#confirmationModal').modal('show');
            })
            window.addEventListener('hide-delete-modal', event => {
                $('#confirmationModal').modal('hide');
                toastr.success(event.detail.message, 'Success!');
            })

        </script>

    @endpush
</div>

