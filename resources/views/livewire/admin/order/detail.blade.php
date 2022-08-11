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
                        <li wire:ignore  class=" nav-item "><a role="tablist"  class="nav-link  " href="#tab-product" data-toggle="tab">کالاها</a></li>
                       <li wire:ignore class=" nav-item "><a role="tablist"  class="nav-link  " href="#tab-history" data-toggle="tab">تاریخچه</a></li>
                       <li wire:ignore class=" nav-item "><a role="tablist"  class="nav-link  " href="#tab-license" data-toggle="tab">لایسنس و پشتیبانی</a></li>
                        </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        مشاهده سفارش {{$order->order_number}}
                    </div>
                    <div class="card-body">

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
                                                    <span class="text-success">موفق </span>

                                                @else
                                                    <span class="text-danger"> ناموفق  </span>
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
                                                    <span class=" text-primary">پرداخت شده</span>

                                                @endif</td>
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
                                <div wire:ignore.self  class="tab-pane"  id="tab-product" >
                                <div class="table-responsive scrollbar" id="style-1">
                                    <table class="table table-bordered" id="printable">
                                        <thead>
                                        <tr>
                                            <td class="text-right">حذف</td>
                                            <td class="text-right">کالا</td>
                                            <td class="text-right">قیمت </td>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td >
                                                    <a href="" wire:click.prevent="deleteProduct({{$order->product_id}})" class="btn btn-sm btn-danger">
                                                        <i class="fe fe-trash"></i>
                                                    </a>
                                                </td>
                                                <td class="text-right">{{$this->title($order->id)}}</td>

                                                <td class="text-right">{{number_format($order->prices)}}تومان</td>
                                            </tr>

                                        <tr>
                                            <td colspan="2" class="text-right">جمع جزء:</td>
                                            <td class="text-right">{{number_format($order->product_price)}} تومان</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2" class="text-right">تخفیف بر روی سبد خرید:</td>
                                            <td class="text-right">{{$order->cart_discount_price}} تومان</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right">کوپن تخفیف:</td>
                                            <td class="text-right">{{$order->copen_price}} تومان</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-right">جمع:</td>
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
                                                            <span class=" text-warning">در حال بررسی</span>
                                                        @elseif ($history->history =='complate')
                                                            <span class=" text-primary">تکمیل شده</span>
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
                                        <form class="form-horizontal">
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label" for="input-order-status">وضعیت سفارش</label>
                                                <div class="col-sm-10">
                                                    <select wire:model="processing" id="input-order-status" class="form-control">
                                                        <option value="">انتخاب</option>
                                                        <option value="wait">در انتظار بررسی</option>
                                                        <option value="complate">تکمیل شده</option>
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
                                                    <textarea wire:model="description" rows="8" id="input-comment" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="text-right">
                                            <button  wire:click.prevent="saveInfo"   id="button-history" data-loading-text="درحال بارگذاری..." class="btn btn-primary"><i class="fa fa-plus-circle"></i> افزودن تاریخچه</button>
                                        </div>
                                    </fieldset>
                                </div>
                                <div wire:ignore.self  class="tab-pane" id="tab-license" >
                                    <div id="license">
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" for="input-comment">لایسنس</label>
                                            <div class="col-sm-7">
                                                <input wire:model="licence"  class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="button" class="btn btn-primary" wire:click.preven="license()">اعمال</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label" for="input-comment">پشتیبانی</label>
                                            <div class="col-sm-7">
                                                <input wire:model="support"  class="form-control">
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="button" class="btn btn-primary" wire:click.preven="support()">اعمال</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


