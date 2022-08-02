@section('title','بنرها')
<div class="container-fluid">
    <div class="inner-body" wire:init="loadCategory">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5"> بنرها</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">بنرها</li>
                </ol>
            </div>
            <div>
                <a class="btn btn-primary" href="{{route('AddBanner')}}">
                    افزودن
                    <i class="fa fa-plus-circle ml-0"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        بنرها
                        @if(count($deleteItem) >=1 )
                            <span class="float-left">
                                    <a href="" wire:click.prevent="confirmAllCategoryRemoval()"
                                       class="btn btn-sm btn-danger">
                                        حذف (
                                    {{count($deleteItem)}})
                                     </a>
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
                            <div class="table-responsive  scrollbar" id="style-1">
                                <table class="table dataTable no-footer dtr-inline ">
                                    <thead role="rowgroup">
                                    <tr role="row" class="title-row">
                                        <th style="padding-right: 15px;" class="wd-lg-5p">
                                            <label class="ckbox">
                                                <input name="selected" wire:model="SelectPage"
                                                       type="checkbox"><span
                                                    class="tx-13"></span>
                                            </label>
                                        </th>
                                        <th>تصویر</th>
                                        <th class="wd-lg-20p">
                                            <span>عنوان</span>
                                            <span wire:click="sortBy('title')" class="float-right text-sm"  style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                             </span>
                                        </th>
                                        <th>
                                            تاریخ ایجاد
                                            <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th>لینک بنر</th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>
                                    @if($readyToLoad)
                                        <tbody>
                                        @foreach($banners as $banner)
                                            <tr role="row">
                                                <td>
                                                    <label class="ckbox">
                                                        <input name="selected" value="{{$banner->id}}" wire:model="mulitiSelect" type="checkbox">
                                                        <span class="tx-13"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <img src="/storage/{{$banner->img}}" alt="img" style="width: 40px;height: 40px;border-radius: 100%">
                                                </td>
                                                <td>
                                                     {!! \Illuminate\Support\Str::limit($banner->title,30,'...') !!}
                                                </td>
                                                <td>{{ verta($banner->created_at)->format('%d/ %B  / %Y') }}</td>
                                                <td>
                                                    @if($banner->link)
                                                        <a target="_blank" href="{{url($banner->link)}}">
                                                            {{\Illuminate\Support\Str::limit($banner->link,20)}}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('banner.update',$banner->id)}}"  class="btn btn-sm btn-info">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <a href=""  wire:click.prevent="confirmCategoryRemoval({{ $banner->id }})"
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
                                    {{$banners->render()}}
                                @endif
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
                    <h5>حذف بنر</h5>
                </div>

                <div class="modal-body">
                    <h4>برای حذف بنر اطمینان دارید؟</h4>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف بنر
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
                    <h5>حذف بنر ها</h5>
                </div>

                <div class="modal-body">
                    <h4>برای حذف گروهی بنرها اطمینان دارید؟</h4>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="deleteAll()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف بنر ها
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
