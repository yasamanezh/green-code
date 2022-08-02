@section('title','پرداخت ها')
<div class="container-fluid">
    <div class="inner-body" wire:init="loadEmail">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">پرداخت ها</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">پرداخت ها</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        پرداخت ها
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <label class="col-sm-4" style="margin-top: 10px">تعداد نمایش :</label>
                                            <div class="col-sm-3">
                                                <select name="example2_length" aria-controls="example2"
                                                        wire:model.lazy="count_data"
                                                        class="form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group mb-2">
                                            <input type="search" wire:model.debounce.1000="search"
                                                   class="form-control border-left-0 pr-3"
                                                   placeholder="جستجو .....">
                                            <span class="input-group-append">
												<button class="btn ripple btn-primary" type="button"><i
                                                        class="fa fa-search"></i></button>
											</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive scrollbar" id="style-1">
                                <table class="table dataTable no-footer dtr-inline ">

                                    <thead role="rowgroup">
                                    <tr role="row" class="title-row">
                                        <th >شماره سفارش</th>
                                        <th >کاربر</th>
                                        <th>مقدار (تومان)</th>
                                    </tr>
                                    </thead>
                                    @if($readyToLoad)
                                        <tbody>
                                        @foreach($orders as $order)
                                            @if($order->status==200)
                                                @if(isset($order->payment_type) && $order->payment_type !='offline')
                                                    <tr role="row">
                                                        <td> {{$order->order_number}} </td>
                                                        <td> {{$order->user->name}} </td>
                                                        <td> {{number_format($order->prices)}} </td>
                                                         </tr>
                                                @endif
                                            @endif
                                        @endforeach

                                        </tbody>
                                        {{$orders->render()}}
                                    @else
                                        <div class="alert-warning alert">
                                            در حال خواندن اطلاعات از دیتابیس ...
                                        </div>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




