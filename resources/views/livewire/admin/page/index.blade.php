@section('title','صفحات سایت')
<div class="container-fluid">
    <div class="inner-body" wire:init="loadCategory">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">صفحات سایت</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">صفحات سایت</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a class="btn btn-primary my-2 btn-icon-text" href="{{route('page.add')}}">افزودن برگه
                    </a>
                    <a class="btn btn-primary my-2 btn-icon-text" href="{{route('page.trashed')}}">سطل زباله
                        ({{\App\Models\Page::onlyTrashed()->count()}})
                    </a>
                </div>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        برگه ها
                        @if(count($deleteItem) >=1 )
                            <span class="float-left">
                                <a href="" wire:click.prevent="confirmAllCategoryRemoval()" class="btn btn-sm btn-danger">حذف ({{count($deleteItem)}})</a>
                        </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div>
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
                            <div class="row">
                                <div class="col-sm-12">

                                    <div  class="table-responsive scrollbar" id="style-1" >
                                        <table class="table dataTable no-footer dtr-inline ">
                                            <thead>
                                            <tr role="row">
                                                <th style="padding-right: 15px;" class="wd-lg-5p">
                                                    <label class="ckbox">
                                                        <input name="selected"  wire:model="SelectPage"
                                                               type="checkbox"><span
                                                            class="tx-13"></span>
                                                    </label>
                                                </th>
                                                <th class="wd-lg-20p">
                                                    <span style="margin-right: 15px;"> عنوان </span>
                                                    <span wire:click="sortBy('title')" class="float-right text-sm"
                                                          style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                        </span>
                                                </th>
                                                <th>لینک</th>
                                                <th class="wd-lg-5p">
                                                    <span style="margin-right: 15px;"> تاریخ ایجاد </span>
                                                    <span wire:click="sortBy('created_at')" class="float-right text-sm"
                                                          style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                        </span>
                                                </th>
                                                <th class="wd-lg-5p">پیش نمایش</th>
                                                <th class="wd-lg-5p">عملیات</th>
                                            </tr>
                                            </thead>
                                            @if($readyToLoad)
                                                <tbody>
                                                @foreach($pages as $info)
                                                    <tr role="row">
                                                        <td>
                                                            <label class="ckbox">
                                                                <input name="selected" value="{{$info->id}}"
                                                                       wire:model="mulitiSelect" type="checkbox"><span
                                                                    class="tx-13"></span>
                                                            </label>
                                                        </td>
                                                        <td>   {!! \Illuminate\Support\Str::limit($info->title,30,'...') !!}
                                                        </td>
                                                        <td>   {{$info->link}}  </td>
                                                        <td>{{ verta($info->created_at)->format('%d/ %B  / %Y') }}</td>
                                                        <td>
                                                            <a target="_blank" href="{{route('AllPages',$info->link)}}" class="btn btn-sm btn-info">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a href="{{route('page.update',$info->id)}}"
                                                               class="btn btn-sm btn-info">
                                                                <i class="fe fe-edit-2"></i>
                                                            </a>
                                                            <a href=""
                                                               wire:click.prevent="confirmCategoryRemoval({{ $info->id }})"
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
                                    </div>
                                    <br>
                                    @if($readyToLoad)
                                        <div>
                                            {{$pages->render()}}
                                        </div>
                                    @endif
                                </div>
                            </div>
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
                    <h5>حذف برگه</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف برگه اطمینان دارید؟</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف برگه
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
                    <h5>حذف برگه ها</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف گروهی برگه ها اطمینان دارید؟</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="deleteAll()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف برگه ها
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

