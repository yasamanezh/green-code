@section('title','کدهای تخفیف')
<div class="container-fluid ">
    <div class="inner-body " >
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">تخفیفات</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تخفیفات</li>
                </ol>
            </div>
            <div>
                <a class="btn btn-primary text-white my-2 btn-icon-text" href="{{route('AddDiscount')}}">افزودن
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row" wire:init="loadDiscount">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        تخفیفات
                        @if(count($deleteItem) >=1 )
                            <span class="float-left">
                                <a href="" wire:click.prevent="confirmAllDiscountRemoval()"
                                   class="btn btn-sm btn-danger">حذف ({{count($deleteItem)}})</a>
                        </span>
                        @endif
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
                                <tr role="row">
                                    <th style="padding-right: 15px;" class="wd-lg-5p">
                                        <label class="ckbox">
                                            <input name="selected" wire:model="SelectPage"
                                                   type="checkbox"><span
                                                class="tx-13"></span>
                                        </label>
                                    </th>
                                    <th style="width: 200px">نوع کد تخفیف</th>
                                    <th>مقدار تخلیف</th>
                                    <th>توضیحات</th>
                                    <th>
                                        تاریخ ایجاد
                                        <span wire:click="sortBy('created_at')" class="float-right text-sm"
                                              style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                        </span>
                                    </th>
                                    <th class="wd-lg-5p">تاریخ انقضا</th>
                                    <th class="wd-lg-5p">وضعیت</th>
                                    <th class="wd-lg-5p">عملیات</th>
                                </tr>
                                </thead>
                                @if($readyToLoad)
                                    <tbody>
                                    @foreach($discounts as $discount)
                                        <tr>
                                            <td>
                                                <label class="ckbox">
                                                    <input name="selected" value="{{$discount->id}}"
                                                           wire:model="mulitiSelect" type="checkbox"><span
                                                        class="tx-13"></span>
                                                </label>
                                            </td>
                                            <td style="width: 200px">
                                                @if($discount->discount == 1)
                                                    تخفیف  چند محصولی
                                                @elseif($discount->discount == 2)
                                                    تخفیف دسته بندی ها
                                                @elseif($discount->discount == 3)
                                                    تخفیف کلی
                                                @elseif($discount->discount == 4)
                                                    کوپن
                                                @elseif($discount->discount == 5)
                                                    تخفیف روی سبد خرید
                                                @endif
                                            </td>
                                            <td>
                                                @if($discount->percent)
                                                    {{$discount->percent}} %
                                                @elseif($discount->price)
                                                    {{$discount->price}}تومان
                                                @endif
                                            </td>
                                            <td>
                                                @if($discount->discount == 1)
                                                    @php $product=explode(',', $discount->product_id); @endphp
                                                    <div class="bootstrap-tagsinput">
                                                        @foreach($product as $key=>$value)
                                                            @if($key >=2) @continue @endif
                                                                @php $discountpro=App\Models\Product::where('id',$value)->first() @endphp

                                                            @isset($discountpro)
                                                                <span  class="badge badge badge-info">{{$discountpro->title}} </span>
                                                            <br>
                                                            @endisset
                                                        @endforeach
                                                        ...
                                                    </div>
                                                @elseif($discount->discount == 3)
                                                    <span>کل محصولات<span>
                                                    @elseif($discount->discount == 4)
                                                                <span> کوپن  {{$discount->code}}<span>
                                                        <p>{{$discount->count}} عدد</p>
                                                    @elseif($discount->discount == 5)
                                                        مبلغ تخفیف بین
                                                                     (  {{number_format($discount->minimum)}}-{{number_format($discount->max)}} )
                                                                            تومان
                                                @endif
                                            </td>
                                            <td>{{ verta($discount->created_at)->format('%d/ %B  / %Y') }}</td>
                                            <td>
                                                @if($this->expire($discount))
                                                    منقضی شده
                                                @else
                                                    {{$discount->date_expire}} @isset($discount->time_expire)
                                                        -    {{$discount->time_expire}} @endisset

                                                @endif
                                            </td>
                                            <td  class="wd-lg-5p">

                                                    <label wire:click.prevent="disableStatus({{$discount->id}})" style="cursor: pointer;"
                                                           class="custom-switch">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                               class="custom-switch-input"  @if($discount->status == 1) checked="checked" @endif>
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>

                                            </td>
                                            <td>
                                                <a href="{{route('EditDiscount',$discount->id)}}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fe fe-edit-2"></i>
                                                </a>
                                                <a wire:click.prevent="confirmDiscountRemoval({{ $discount->id }})"
                                                   class="btn btn-sm btn-danger text-white">
                                                    <i class="fe fe-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    {{$discounts->render()}}
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
    <script>
        document.querySelector('#submit').addEventListener('click', () => {
            var tag = $('#note').val();
            let tags = $('#note').data('note');
            eval(tags).set('discount.date_expire', tag);
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>حذف تخفیف</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف تخفیف اطمینان دارید؟</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف تخفیف
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
                    <h5>حذف تخفیف ها</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف گروهی تخفیف ها اطمینان دارید؟</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="deleteAll()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف تخفیف ها
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

        window.addEventListener('alert', event => {
            toastr.success(event.detail.message, 'Success!');
        })

        window.addEventListener('updated', event => {
            toastr.success(event.detail.message, 'Success!');
        })

        $('[x-ref="profileLink"]').on('click', function () {
            localStorage.setItem('_x_currentTab', '"profile"');
        });
        $('[x-ref="changePasswordLink"]').on('click', function () {
            localStorage.setItem('_x_currentTab', '"changePassword"');
        });
    </script>
@endpush



