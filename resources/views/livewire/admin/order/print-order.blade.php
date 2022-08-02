@section('title','چاپ فاکتور')
<div>
    <div class="top-line"></div>
    <div class="template-8 container">
        <table class="header-table table-responsive table-fixed">
            <tbody>
            <tr>
                <td>
                    <div class="shop-logo"><img src="/storage/{{$siteOption->logo}}"></div>
                </td>
                <td class="invoice-title">صورت‌ حساب </td>
                <td class="print-date">
                    <div class="component print-date">
                        <span class="content"><span class="title">تاریخ چاپ:</span>
                            <span class="inner-content" dir="ltr">{{$now}}</span>
                        </span>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="shop-customer-table table-responsive table-bordered">
            <tbody>
            @if($siteOption)
                <tr>
                    <th>
                        <span>فروشنده</span>
                    </th>
                    <td class="info">
                        <div class="component title">
                        <span class="content"><span class="title">عنوان:</span>
                            <span class="inner-content">{{$siteOption->name}}</span>
                        </span>
                        </div>
                        <div class="component address">
                        <span class="content"><span class="title">آدرس:</span>
                            <span  class="inner-content">
                                {{\App\Models\Country::where('id',$siteOption->zone)->pluck('name')->first()}}-
                                {{\App\Models\City::where('id',$siteOption->city)->pluck('name')->first()}}
                                {{$siteOption->	address}}
                                <br>
                            </span>
                        </span>
                        </div>

                    </td>
                    <td class="last">
                        <div class="component url">
                        <span class="content">
                            <span class="title">وب‌سایت:</span>
                            <span  class="inner-content">{{\Illuminate\Support\Facades\URL::to('/')}}</span>
                        </span>
                        </div>
                        <div class="component phone">
                        <span class="content">
                            <span class="title">تلفن:</span>
                            <span class="inner-content">{{$siteOption->telephone}}</span></span></div>
                    </td>
                </tr>
            @endif
            <tr>
                <th>
                    <span>خریدار</span>
                </th>
                <td class="info">
                    <div class="component full-name"><span class="content"><span class="title">نام:</span><span
                                class="inner-content"><span class="content1">{{$order->name}}</span></span></span></div>
                    @if($order->address)
                    <div class="component recipient"><span class="content"><span class="title">گیرنده:</span><span
                                class="inner-content"><span class="content1">
                                    {{\App\Models\Country::where('id',$order->zone)->pluck('name')->first()}}-
                                {{\App\Models\City::where('id',$order->city)->pluck('name')->first()}}
                                    {{$order->address}}
                                    -کدپستی:
                                    {{$order->code_posti}}
                                </span></span></span>
                    </div>
                    @endif
                    <div class="component phone"><span class="content"><span class="title">تلفن:</span><span
                                class="inner-content"><span class="content1">{{$order->mobile}}</span></span></span></div>
                    <div class="component order-date"><span class="content"><span class="title">تاریخ  ثبت سفارش:</span><span
                                class="inner-content" dir="ltr">
                    @if($order->status == 200)
                        {{ verta($order->created_at)}}
                    @else
                        {{ verta($order->updated_at)}}
                    @endif
                            </span></span></div>
                </td>
                <td class="last">
                    <div class="component order-id"><span class="content"><span class="title">شناسه سفارش:</span><span
                                class="inner-content">

                                {{$order->order_number}}
                            </span></span></div>
                    <div class="component order-status"><span class="content"><span class="title">وضعیت سفارش:</span><span
                                class="inner-content">@if($order->processing =='wait')
                                    در انتظار پرداخت
                                @elseif ($order->processing =='complate')
                                    در صف بررسی
                                @elseif ($order->processing =='progress')
                                    در حال آماده سازی سفارش
                                @elseif ($order->processing =='sended')
                                    خروج از مرکز پردازش
                                @elseif ($order->processing =='post')
                                    تحویل به پست
                                @elseif ($order->processing =='delivered')
                                    تحویل مرسوله به مشتری
                                @endif</span></span></div>

                </td>
            </tr>
            </tbody>
        </table>
        <div style="padding: 0 5px;">
            <table class="products-table table-responsive table-bordered">
                <thead>
                <tr>
                    <th class="row">ردیف</th>
                    <th class="id">شناسه</th>
                    <th class="product">محصول</th>
                    <th class="price">قیمت</th>
                    <th class="quantity">تعداد</th>
                    <th class="total-amount">مبلغ کل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->products as $product)
                    <tr class="odd">
                        <td class="row"><span>{{$counter}}</span></td>
                        <td class="id"><span class="td-title">شناسه</span>{{$product->product_id}}</td>
                        <td class="product"><span class="td-title">محصول</span><a href="#">{{$product->title}} </a></td>
                        <td class="price"><span class="td-title">قیمت</span>
                            <ins>
                            <span class="woocommerce-Price-amount amount">
                                <bdi>
                                    {{number_format($product->price)}}&nbsp;
                                    <span class="woocommerce-Price-currencySymbol">تومان</span>
                                </bdi>
                            </span>
                            </ins>
                        </td>
                        <td class="quantity"><span class="td-title">تعداد</span>{{$product->count}}</td>
                        <td class="total-amount"><span class="td-title">مبلغ کل</span><span
                                class="woocommerce-Price-amount amount"><bdi>{{number_format($product->price*$product->count)}}&nbsp;<span
                                        class="woocommerce-Price-currencySymbol">تومان</span></bdi></span></td>
                    </tr>
                    @php
                        $counter++;
                        $totalcount=$totalcount+(int)$product->count;
                    @endphp
                @endforeach
                </tbody>
            </table>
            <div class="profit-wrapper">
                <div class="total-items"><span class="title">تعداد کل : </span><span class="content">{{$totalcount}}</span></div>
            </div>
            <table class="table-fixed table-responsive">
                <tbody>
                <tr>
                    <td class="note-cell">
                    </td>
                    <td class="total-cell">
                        <table class="total-table table-responsive table-bordered table-fixed">
                            <tbody>
                            <tr>
                                <th class="total">مبلغ کل</th>
                                <td class="total"><span class="woocommerce-Price-amount amount"><bdi>{{number_format($order->product_price)}}<span
                                                class="woocommerce-Price-currencySymbol">تومان</span></bdi></span></td>
                            </tr>
                            @if($order->shipping_price)
                            <tr>
                                <td  class="text-right">هزینه حمل و نقل:</td>
                                <td class="text-right">{{$order->shipping_price}}</td>
                            </tr>
                            @endif
                            @if($order->cart_discount_price)
                            <tr>
                                <td  class="text-right">تخفیف بر روی سبد خرید:</td>
                                <td class="text-right">{{$order->cart_discount_price}} تومان</td>
                            </tr>
                            @endif
                            @if($order->copen_price)
                            <tr>
                                <td  class="text-right">کوپن تخفیف:</td>
                                <td class="text-right">{{$order->copen_price}} تومان</td>
                            </tr>
                            @endif
                            <tr>
                                <td class="text-right">جمع:</td>
                                <td class="text-right">{{number_format($order->prices)}} تومان</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="signature-table table-responsive table-fixed table-bordered">
                <tbody>
                <tr>
                    <td>
                        <div class="component shop-signature">
                            <span class="content">
                                <span class="title">مهر و امضای فروشگاه</span>
                                <span class="inner-content" style="height:150px">
                                    @if($siteOption->Signature)
                                    <img src="/storage/{{$siteOption->Signature}}" style="width: 150px;height: 150px">
                                     @endif
                                </span>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="component customer-signature"><span class="content"><span class="title">مهر و امضای مشتری</span><span
                                    class="inner-content"></span></span></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="print">
        <a href="#"
           class="button" onclick="print()">چاپ این برگه</a>
        <a href="{{route('admin.orders.index')}}"
           class="button">بازگشت</a>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            $('body').persiaNumber();
        });
    </script>
</div>
