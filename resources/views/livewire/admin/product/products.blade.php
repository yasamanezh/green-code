@section('title','محصولات')
<div class="container-fluid" style="overflow-x: hidden !important;">
    <div class="inner-body" wire:init="loadProduct">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">محصولات</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">محصولات</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a class="btn ripple btn-primary text-white " href="{{route('AddProduct')}}">افزودن
                        <i class="fa fa-plus-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row">
            <div class="col-lg-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        محصولات
                        @if(count($deleteItem) >=1 )
                            <span class="float-left">
                                <a href="" wire:click.prevent="confirmAllProductRemoval()"
                                   class="btn btn-sm btn-danger">حذف ({{count($deleteItem)}})
                                 </a>
                        </span>
                        @endif
                    </div>
                    <div class="card-body">
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
                                <tr role="row">
                                    <th style="padding-right: 15px;" class="wd-lg-5p">
                                        <label class="ckbox">
                                            <input name="selected" wire:model="SelectPage"
                                                   type="checkbox"><span
                                                class="tx-13"></span>
                                        </label>
                                    </th>
                                    <th class="wd-lg-5p">تصویر</th>
                                    <th class="wd-lg-20p"><span style="margin-right: 15px;">عنوان</span>
                                        <span wire:click="sortBy('title')" class="float-right text-sm"
                                              style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                        </span>
                                    </th>
                                    <th class="wd-lg-5p">
                                        <span style="margin-right: 15px;"> تاریخ ایجاد </span>
                                        <span wire:click="sortBy('created_at')" class="float-right text-sm"
                                              style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                        </span>
                                    </th>
                                    <th class="wd-lg-5p">قیمت</th>
                                    <th class="wd-lg-5p">تعداد</th>
                                    <th class="wd-lg-5p">مشاهده سریع</th>
                                    <th class="wd-lg-5p">وضعیت</th>
                                    <th class="wd-lg-5p">عملیات</th>
                                </tr>
                                </thead>
                                @if($readyToLoad)
                                    <tbody>
                                    @foreach($data_info as $key=>$data)
                                        <tr>
                                            <td>
                                                <label class="ckbox">

                                                    <input name="selected" value="{{$data->id}}"
                                                           wire:model="mulitiSelect" type="checkbox"><span
                                                        class="tx-13"></span>
                                                </label>
                                            </td>
                                            <td><img src="/storage/{{$data->image}}"
                                                     style="width: 40px;height: 40px;border-radius: 100%"/>
                                            </td>
                                            <td>
                                            {!! \Illuminate\Support\Str::limit($data->title,30,'...') !!}

                                            </td>
                                            <td>{{ verta($data->created_at)->format('%d/ %B  / %Y') }}</td>
                                            <td   wire:change="changePrice({{$data->id}})">
                                                <div style="position: absolute" wire:loading
                                                     wire:target="price.{{$data->id}}"
                                                     class="spinner-grow text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <div class="wd-150">
                                                <input wire:model.lazy="price.{{$data->id}}"
                                                       class="form-control">
                                                </div>
                                                @error("price.$data->id")
                                                <div class="invalid-feedback display-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </td>

                                            <td wire:change="changeQuantity({{$data->id}})">
                                                <div style="position: absolute" wire:loading
                                                     wire:target="quantity.{{$data->id}}"
                                                     class="spinner-grow text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                <div class="wd-150">
                                                    <input wire:model.lazy="quantity.{{$data->id}}"
                                                           class="form-control">
                                                </div>
                                                @error("quantity.$data->id")
                                                <div class="invalid-feedback display-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror

                                            </td>
                                            <td>
                                                <a target="_blank" href="{{route('SingleProduct',$data->slug)}}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                            <td>


                                                    <label class="custom-switch" style="cursor: pointer;"
                                                           wire:click.prevent="statusDisable({{$data->id}})">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                               class="custom-switch-input"
                                                               @if($data->status==1)    checked="checked"   @endif >
                                                        <span class="custom-switch-indicator"></span>

                                                    </label>

                                            </td>
                                            <td>
                                                <a href="{{route('EditProduct',$data->id)}}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fe fe-edit-2"></i>
                                                </a>
                                                <a href=""
                                                   wire:click.prevent="confirmProductRemoval({{ $data->id }})"
                                                   class="btn btn-sm btn-danger">
                                                    <i class="fe fe-trash"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                @else
                                    <div class="alert-warning alert">
                                        در حال خواندن اطلاعات از دیتابیس ...
                                    </div>
                                @endif
                            </table>
                            @if($readyToLoad)
                                {{$data_info->links()}}
                            @endif
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
                    <h5>حذف محصول</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف محصول اطمینان دارید؟</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف محصول
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
                    <h5>حذف محصول ها</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف گروهی محصول ها اطمینان دارید؟</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="deleteAll()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف محصول ها
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

