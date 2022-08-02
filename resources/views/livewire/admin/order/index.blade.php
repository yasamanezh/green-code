@section('title','سفارشات')
<div class="container-fluid">
    <div class="inner-body" wire:init="loadOrder">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">سفارشات</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">سفارشات</li>
                </ol>

            </div>
        </div>
        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="card custom-card">
                    <div class="card custom-card">
                        <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                            سفارش ها
                            @if(count($deleteItem) >=1 )
                                <span class="float-left">

                                    <a href="" wire:click.prevent="confirmAllOrderRemoval()"
                                       class="btn btn-sm btn-danger">
                                        حذف (
                                    {{count($deleteItem)}})
                                     </a>

                        </span>
                            @endif
                        </div>

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
                                <table class="table dataTable no-footer dtr-inline " id="example2"
                                       role="grid" aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row" class="title-row">
                                        <th style="padding-right: 15px;" class="wd-lg-5p">
                                            <label class="ckbox">
                                                <input name="selected" wire:model="SelectPage"
                                                       type="checkbox"><span
                                                    class="tx-13"></span>
                                            </label>
                                        </th>
                                        <th>شماره سفارش</th>
                                        <th>کاربر سفارش دهنده</th>
                                        <th>وضعیت پرداخت</th>
                                        <th>وضعیت سفارش</th>
                                        <th>جمع کل سفارش</th>
                                        <th>تاریخ ثبت سفارش</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>
                                    @if($readyToLoad)
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr role="row">
                                                <td>
                                                    <label class="ckbox" >
                                                        <input name="selected" value="{{$order->id}}" wire:model="mulitiSelect" type="checkbox"><span class="tx-13"></span>
                                                    </label>
                                                </td>
                                                <td>{{$order->order_number}}</td>
                                                <td>{{$order->user->name}}</td>
                                                <td>
                                                    @if($order->status ==200)
                                                        @if($order->payment_type=='offline')
                                                            <span class="text-success"> پرداخت موقع تحویل </span>
                                                        @else
                                                            <span class="text-success">آنلاین (موفق) </span>
                                                        @endif
                                                    @else
                                                        <span class="text-danger">آنلاین (ناموفق)  </span>
                                                    @endif
                                                </td>
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
                                                <td>{{number_format($order->prices)}} تومان</td>

                                                @if($order->status == 200)
                                                    <td>{{ verta($order->created_at)->format('%d/ %B  / %Y') }}</td>
                                                @else
                                                    <td>{{ verta($order->updated_at)->format('%d/ %B  / %Y') }}</td>
                                                @endif
                                                <td>
                                                    <a href="" wire:click.prevent="confirmOrderRemoval({{ $order->id }})" class="btn btn-sm btn-danger">
                                                        <i class="fe fe-trash"></i>
                                                    </a>
                                                    <a href="{{route('AdminDetailOrder',$order->id)}}" class="btn btn-sm btn-info">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a target="_blank" href="{{route('AdminPrintOrder',$order->id)}}"   data-toggle="tooltip" id="btn" class="btn btn-primary btn-sm text-white print" data-original-title="چاپ فاکتور">
                                                        <i class="fa fa-print"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        {{$orders->render()}}
                                    @else
                                    <div class="alert-warning alert"> در حال خواندن اطلاعات از دیتابیس ... </div>
                                    @endif
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>حذف سفارش</h5>
                </div>

                <div class="modal-body">
                    <h4>برای حذف سفارش اطمینان دارید؟</h4>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف سفارش
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>حذف سفارش ها</h5>
                </div>

                <div class="modal-body">
                    <h4>برای حذف گروهی سفارش ها اطمینان دارید؟</h4>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button"  wire:click.prevent="deleteAll()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف سفارش  ها
                    </button>
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




