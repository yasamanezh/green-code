@section('title','مشاهده سفارش')
<div class="container-fluid">
    <div class="inner-body" >
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">مشاهده سفارش</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.orders.index')}}">سفارشات</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> مشاهده سفارش</li>
                </ol>
            </div>
            <div>
                <a target="_blank" href="{{route('AdminPrintOrder',$order->id)}}"   data-toggle="tooltip" id="btn" class="btn btn-primary text-white print" data-original-title="چاپ فاکتور">
                    <i class="fa fa-print"></i>
                </a>
                <a  data-toggle="tooltip" href="{{route('admin.orders.index')}}" class="btn btn-warning text-white" data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>


        </div>
    @include('livewire.admin.layouts.message')
    <!-- Row -->
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <ul class="item1-links nav nav-tabs  mb-0">
                         <li wire:ignore  class=" nav-item " ><a role="tablist"  class="nav-link active " href="#tab-order" data-toggle="tab">جزئیات سفارش</a></li>
                       @if($order->address) <li wire:ignore  class=" nav-item "><a role="tablist"  class="nav-link  " href="#tab-shipping" data-toggle="tab">جزئیات حمل و نقل</a></li>@endif
                        <li wire:ignore  class=" nav-item "><a role="tablist"  class="nav-link  " href="#tab-product" data-toggle="tab">کالاها</a></li>
                       @if($order->address) <li wire:ignore class=" nav-item "><a role="tablist"  class="nav-link  " href="#tab-history" data-toggle="tab">تاریخچه</a></li>@endif
                        </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        مشاهده سفارش {{$order->order_number}}
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveInfo">
                            <div class="tab-content">
                                <div  wire:ignore.self  class="tab-pane active" id="tab-order">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>شناسه سفارش:</td>
                                            <td>#{{$order->order_number}}</td>
                                        </tr>
                                        <tr>
                                            <td>مشتری:</td>
                                            <td>{{$user->name}} </td>
                                        </tr>

                                        <tr>
                                            <td>ایمیل:</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>تلفن:</td>
                                            <td>{{$order->mobile}}</td>
                                        </tr>
                                         <tr>
                                            <td>وضعیت پرداخت:</td>
                                            <td>@if($order->status ==200)
                                                    @if($order->payment_type=='offline')
                                                        <span class="text-success"> پرداخت موقع تحویل </span>
                                                    @else
                                                        <span class="text-success">آنلاین (موفق) </span>
                                                    @endif
                                                @else
                                                    <span class="text-danger">آنلاین (ناموفق)  </span>
                                                @endif</td>
                                        </tr>

                                        <tr>
                                            <td>جمع:</td>
                                            <td> {{number_format($order->prices)}} تومان</td>
                                        </tr>
                                        <tr>
                                            <td>وضعیت سفارش:</td>
                                            <td id="order-status">
                                                @if($order->processing =='wait')
                                                    <span class=" text-warning">در انتظار پرداخت</span>
                                                @elseif ($order->processing =='complate')
                                                    <span class=" text-primary">کامل شده</span>
                                                @elseif ($order->processing =='progress')
                                                    <span class=" text-dark">در حال آماده سازی سفارش</span>
                                                @elseif ($order->processing =='sended')
                                                    <span class=" text-info">خروج از مرکز پردازش</span>
                                                @elseif ($order->processing =='post')
                                                    <span class=" text-success">تحویل به پست</span>
                                                @elseif ($order->processing =='delivered')
                                                    <span class=" text-success">تحویل مرسوله به مشتری</span>
                                                @endif</td>
                                        </tr>
                                        <tr>
                                            <td>توضیح:</td>
                                            <td>{{$order->description}} </td>
                                        </tr>

                                        <tr>
                                            <td>تاریخ افزودن:</td>
                                            @if($order->status == 200)
                                            <td>{{ verta($order->created_at)->format('%d  %B %Y') }}</td>
                                            @else
                                                <td>{{ verta($order->updated_at)->format('%d/ %B  / %Y') }}</td>
                                            @endif
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div wire:ignore.self  class="tab-pane"  id="tab-shipping">
                                    <table class="table table-bordered">
                                        <tbody><tr>
                                            <td>نام تحویل گیرنده:</td>
                                            <td>{{$order->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>آدرس :</td>
                                            <td>{{$order->address}} </td>
                                        </tr>
                                        <tr>
                                            <td>استان:</td>
                                            <td>{{\App\Models\Country::where('id',$order->zone)->pluck('name')->first()}} </td>
                                        </tr>
                                        <tr>
                                            <td>شهر:</td>
                                            <td>{{\App\Models\City::where('id',$order->city)->pluck('name')->first()}} </td>
                                        </tr>
                                        @if($order->shipping_type)
                                        <tr>
                                            <td>روش حمل و نقل:</td>
                                            <td>{{$order->shipping_type}}</td>
                                        </tr>
                                        @endif
                                        @if($order->shipping_price)
                                        <tr>
                                            <td>هزینه حمل و نقل:</td>
                                            <td>{{$order->shipping_price}}</td>
                                        </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                                <div wire:ignore.self  class="tab-pane"  id="tab-product" >
                                <div class="table-responsive scrollbar" id="style-1">
                                    <table class="table table-bordered" id="printable">
                                        <thead>
                                        <tr>
                                            <td class="text-right">حذف</td>
                                            <td class="text-right">کالا</td>
                                            <td class="text-right">تعداد</td>
                                            <td class="text-right">قیمت واحد</td>
                                            <td class="text-right">مکان</td>
                                            <td class="text-right">جمع</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->products as $product)
                                            <tr>
                                                <td >
                                                    <a href="" wire:click.prevent="deleteProduct({{$product->id}})" class="btn btn-sm btn-danger">
                                                        <i class="fe fe-trash"></i>
                                                    </a>
                                                </td>
                                                <td class="text-right">{{$product->title}}</td>
                                                <td class="text-right">{{$product->count}}</td>
                                                <td class="text-right">{{number_format($product->price)}}تومان</td>

                                                @if(\App\Models\Product::where('id',$product->product_id)->first())
                                                    <td class="text-right">{{\App\Models\Product::where('id',$product->product_id)->pluck('location')->first()}}</td>
                                                @else
                                                    <td></td>
                                                @endif

                                                <td class="text-right">{{number_format($product->price*$product->count)}} تومان</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" class="text-right">جمع جزء:</td>
                                            <td class="text-right">{{number_format($order->product_price)}} تومان</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">هزینه حمل و نقل:</td>
                                            <td class="text-right">{{$order->shipping_price}} تومان</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">تخفیف بر روی سبد خرید:</td>
                                            <td class="text-right">{{$order->cart_discount_price}} تومان</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">کوپن تخفیف:</td>
                                            <td class="text-right">{{$order->copen_price}} تومان</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">جمع:</td>
                                            <td class="text-right">{{number_format($order->prices)}} تومان</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                                <div wire:ignore.self  class="tab-pane" id="tab-history" >
                                    <div id="history">
                                        <div class="table-responsive scrollbar" id="style-1">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <td >تاریخ افزودن</td>
                                                <td >توضیح</td>
                                                <td >وضعیت</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td >{{ verta($order->updated_at) }}</td>
                                                <td ></td>
                                                <td>در حال بررسی</td>

                                            </tr>
                                            @foreach(\App\Models\OrderHistory::where('order_id',$order->id)->get() as $history)

                                                <tr>
                                                    <td >{{ verta($history->creaed_at) }}</td>
                                                    <td >{{ $history->description}}</td>
                                                    <td>
                                                        @if($history->history =='wait')

                                                            <span class=" text-warning">در انتظار پرداخت</span>
                                                        @elseif ($history->history =='complate')
                                                            <span class=" text-primary">کامل شده</span>
                                                        @elseif ($history->history =='progress')
                                                            <span class=" text-dark">در حال آماده سازی سفارش</span>
                                                        @elseif ($history->history =='sended')
                                                            <span class=" text-info">خروج از مرکز پردازش</span>
                                                        @elseif ($history->history =='post')
                                                            <span class=" text-success">تحویل به پست</span>
                                                        @elseif ($history->history =='delivered')
                                                            <span class=" text-success">تحویل مرسوله به مشتری</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    <br>
                                    <fieldset>
                                        <legend>افزودن تاریخچه سفارش</legend>
                                        <form class="form-horizontal" wire:submit.prevent="saveInfo()">
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="input-order-status">وضعیت سفارش</label>
                                                <div class="col-sm-10">
                                                    <select wire:model.defer="processing" id="input-order-status" class="form-control">
                                                        <option value="">انتخاب</option>
                                                        <option value="wait">در انتظار پرداخت</option>
                                                        <option value="complate">درصف بررسی</option>
                                                        <option value="progress">آماده‌سازی سفارش</option>
                                                        <option value="sended">خروج از مرکز پردازش</option>
                                                        <option value="post">تحویل به پست</option>
                                                        <option value="delivered">تحویل مرسوله به مشتری</option>
                                                    </select>
                                                    @error('processing')
                                                    <br>
                                                    <span style="color: red">{{$message}}</span>
                                                    @enderror
                                                 </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="input-comment">توضیح</label>
                                                <div class="col-sm-10">
                                                    <textarea wire:model.defer="description" rows="8" id="input-comment" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="text-right">
                                            <button type="submit" id="button-history" data-loading-text="درحال بارگذاری..." class="btn btn-primary"><i class="fa fa-plus-circle"></i> افزودن تاریخچه</button>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


