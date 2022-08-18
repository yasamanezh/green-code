@section('title','داشبورد')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">خوش آمدید</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">داشبورد</li>
                </ol>
            </div>

        </div>
        <div class="row row-sm">
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-order ">
                            <label class="main-content-label mb-3 pt-1">کاربران جدید</label>
                            <h2 class="text-left card-item-icon card-icon">
                                <i class="mdi mdi-account-multiple icon-size float-right text-primary"></i>
                                <span class="font-weight-bold" wire:loading.delay.remove
                                      wire:target="getUsersCount">{{$usersCount}}</span>

                                <div wire:loading.delay wire:target="getUsersCount">
                                    <div class="spinner-border text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>

                                <br>
                                <p class="mb-0 mt-3 text-muted"><span class="float-left"
                                                                      style="font-size: 20px;">نفر</span></p>
                            </h2>
                            <p class="mb-0 mt-4 text-muted">
                                    <span class="float-right">
                                        <select class="form-control" wire:change="getUsersCount($event.target.value)">
                                            <option value="TODAY">امروز</option>
                                            <option value="MTD">ماهیانه</option>
                                            <option value="YTD">365 روز گذشته</option>
                                        </select>

                                    </span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-order ">
                            <label class="main-content-label mb-3 pt-1">کل سفارشات</label>
                            <h2 class="text-left card-item-icon card-icon">
                                <i class="mdi mdi-cart icon-size float-right text-primary"></i>
                                <span class="font-weight-bold" wire:loading.delay.remove
                                      wire:target="getOrderPrice">{{$getOrderPrice}}</span>

                                <div wire:loading.delay wire:target="getOrderPrice">
                                    <div class="spinner-border text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>

                                <br>
                                <p class="mb-0 mt-3 text-muted"><span class="float-left"
                                                                      style="font-size: 20px;">سفارش</span></p>
                            </h2>
                            <p class="mb-0 mt-4 text-muted">
                                    <span class="float-right">
                                        <select class="form-control" wire:change="getOrderPrice($event.target.value)">
                                            <option value="TODAY">امروز</option>
                                            <option value="MTD">ماهیانه</option>
                                            <option value="YTD">365 روز گذشته</option>
                                        </select>

                                    </span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-order ">
                            <label class="main-content-label mb-3 pt-1">کل فروش</label>
                            <h2 class="text-left card-item-icon card-icon">
                                <i class="mdi mdi-cash-multiple icon-size float-right text-primary"></i>
                                <span class="font-weight-bold" wire:loading.delay.remove
                                      wire:target="getOrder">{{$getOrder}}</span>

                                <div wire:loading.delay wire:target="getOrder">
                                    <div class="spinner-border text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>

                                <br>
                                <p class="mb-0 mt-3 text-muted"><span class="float-left"
                                                                      style="font-size: 20px;">سفارش</span></p>
                            </h2>
                            <p class="mb-0 mt-4 text-muted">
                                    <span class="float-right">
                                        <select class="form-control" wire:change="getOrder($event.target.value)">
                                            <option value="TODAY">امروز</option>
                                            <option value="MTD">ماهیانه</option>
                                            <option value="YTD">365 روز گذشته</option>
                                        </select>

                                    </span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="card-order ">
                            <label class="main-content-label mb-3 pt-1">درآمد کل</label>
                            <h2 class="text-left card-item-icon card-icon">
                                <i class="mdi mdi-currency-usd icon-size float-right text-primary"></i>
                                <span class="font-weight-bold" wire:loading.delay.remove
                                      wire:target="Price">{{number_format($Price)}}</span>

                                <div wire:loading.delay wire:target="Price">
                                    <div class="spinner-border text-success" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <br>
                                <p class="mb-0 mt-3 text-muted"><span class="float-left"  style="font-size: 20px;">تومان</span></p>
                            </h2>
                            <p class="mb-0 mt-4 text-muted">
                                    <span class="float-right">
                                        <select class="form-control" wire:change="Price($event.target.value)">
                                            <option value="TODAY">امروز</option>
                                            <option value="MTD">ماهیانه</option>
                                            <option value="YTD">365 روز گذشته</option>
                                        </select>

                                    </span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- COL END -->

        </div>
        <!-- End Row -->


        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xxl-12 col-xl-12 col-md-12 col-lg-12">
                <div class="card custom-card">
                    <div class="card-header border-bottom-0 pb-1">
                        <label class="main-content-label mb-2 pt-1">آخرین سفارشات</label>
                        <p class="tx-12 mb-0 text-muted">آخرین سفارشات ثبت شده در فروشگاه شما</p>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive scrollbar" id="style-1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td class="text-right">شناسه سفارش</td>
                                    <td>مشتری</td>
                                    <td>وضعیت</td>
                                    <td>وضعیت پرداخت</td>
                                    <td>تاریخ  ثبت سفارش</td>
                                    <td class="text-right">جمع کل (تومان)</td>
                                    <td class="text-right">عملیات</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="text-right">{{$order->order_number}}</td>
                                        <td>{{$order->user->name}}</td>
                                        <td>
                                            @if($order->processing =='wait')
                                                <span class=" text-warning">در انتظار پرداخت</span>
                                            @elseif ($order->processing =='complate')
                                                <span class=" text-primary">در حال بررسی</span>
                                            @elseif ($order->processing =='progress')
                                                <span class=" text-dark">در حال آماده سازی سفارش</span>
                                            @elseif ($order->processing =='sended')
                                                <span class=" text-info">خروج از مرکز پردازش</span>
                                            @elseif ($order->processing =='post')
                                                <span class=" text-success">تحویل به پست</span>
                                            @elseif ($order->processing =='delivered')
                                                <span class=" text-success">تحویل مرسوله به مشتری</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($order->status =='NOK')
                                                <span class=" text-danger">پرداخت ناموفق</span>
                                            @elseif ($order->status =='1' && isset($order->transactionId))
                                                <span class=" text-danger">پرداخت ناموفق</span>
                                            @elseif ($order->status =='1')
                                                <span class=" text-warning">در انتظار پرداخت</span>
                                            @elseif ($order->status =='200')
                                                <span class=" text-success">پرداخت موفق</span>
                                            @endif
                                        </td>
                                        @if($order->status == 200)
                                            <td  class="text-right">{{ verta($order->created_at)->format('%d/ %B  / %Y') }}</td>
                                        @else
                                            <td class="text-right">{{ verta($order->updated_at)->format('%d/ %B  / %Y') }}</td>
                                        @endif
                                        <td class="text-right">{{number_format($order->prices)}}</td>
                                        <td>
                                            <a href="{{route('AdminDetailOrder',$order->id)}}"
                                               class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-xxl-12 col-xl-12 col-md-12 col-lg-12">
                <div class="card custom-card">
                    <div class="card-header border-bottom-0 pb-1">
                        <label class="main-content-label mb-2 pt-1">آخرین پیام ها</label>
                        <p class="tx-12 mb-0 text-muted">آخرین پیام های ثبت شده در فروشگاه شما</p>
                    </div>
                    <div class="product-timeline card-body pt-3 mt-1">
                        <div class="table-responsive">
                            <table class="table dataTable no-footer dtr-inline ">

                                <thead role="rowgroup">
                                <tr role="row" class="title-row">

                                    <th>نام</th>
                                    <th>ایمیل</th>
                                    <th>متن پیام</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($contacts as $value)

                                    <tr role="row">

                                        <td> {{$value->name}}</td>
                                        <td> {{$value->email}}</td>
                                        <td> {{\Illuminate\Support\Str::limit($value->content, 30)}}</td>

                                        <td>
                                            <a href="{{route('showContact',$value->id)}}" class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>


                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->


    </div>
</div>
