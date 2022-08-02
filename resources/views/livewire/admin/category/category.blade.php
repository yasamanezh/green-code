@section('title','دسته بندی ها')
<div class="container-fluid" wire:init="loadCategory">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">دسته بندی ها</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">دسته بندی ها</li>
                </ol>
            </div>
            <div>
                <a class="btn btn-primary my-2 btn-icon-text" href="{{route('AddCategory')}}">افزودن
                    <i class="fa fa-plus-circle"></i>
                </a>
                <a class="btn btn-primary my-2 btn-icon-text" href="{{route('Trashed')}}">سطل زباله
                    ({{\App\Models\Category::onlyTrashed()->count()}})
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        دسته بندی ها
                        @if(count($deleteItem) >=1 )
                            <span class="float-left">
                                <a href="" wire:click.prevent="confirmAllCategoryRemoval()"
                                   class="btn btn-sm btn-danger">حذف ({{count($deleteItem)}})
                                 </a>
                        </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div >
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
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
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive scrollbar" id="style-1">
                                            <table class="table dataTable no-footer dtr-inline collapsed" id="example2"
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
                                                    <th class="wd-lg-20p">
                                                        <span style="margin-right: 15px;"> عنوان </span>
                                                        <span wire:click="sortBy('title')" class="float-right text-sm"
                                                              style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                    </span>
                                                    </th>
                                                    <th>
                                                        <span style="margin-right: 15px;"> تاریخ ایجاد </span>
                                                        <span wire:click="sortBy('created_at')"
                                                              class="float-right text-sm"
                                                              style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                    </span>
                                                    </th>
                                                    <th class="wd-lg-5p">وضعیت</th>
                                                    <th class="wd-lg-5p">عملیات</th>
                                                </tr>
                                                </thead>
                                                @if($readyToLoad)
                                                    <tbody>
                                                    @foreach($data_info as $info)
                                                        <tr role="row">
                                                            <td>
                                                                <label class="ckbox">
                                                                    <input name="selected" value="{{$info->id}}"
                                                                           wire:model="mulitiSelect"
                                                                           type="checkbox"><span
                                                                        class="tx-13"></span>
                                                                </label>
                                                            </td>
                                                            <td><img src="/storage/{{$info->img}} "
                                                                     style="width: 40px;height: 40px;border-radius: 100%">
                                                            </td>
                                                            <td>
                                                                @if(isset($info->parent) && $info->parent !=0 )
                                                                    @php
                                                                        $firstParet=\App\Models\Category::where('id',$info->parent)->first();
                                                                       if($firstParet){
                                                                        $secondParent=\App\Models\Category::where('parent',$firstParet->parent)->first();
                                                                        $secondParenttitle=\App\Models\Category::where('id',$secondParent->parent)->first();
                                                                        }
                                                                       if(isset($secondParenttitle)){
                                                                           $level=3;
                                                                       }else{
                                                                           $level=2;
                                                                       }
                                                                    @endphp
                                                                    @if($level==2)
                                                                        {{$firstParet->title}}  > {{$info->title}}
                                                                    @elseif($level==3)
                                                                        {{$secondParenttitle->title}}
                                                                        >{{$firstParet->title}}  > {{$info->title}}
                                                                    @endif
                                                                @else
                                                                    @php $level=1;  @endphp
                                                                    {{$info->title}}
                                                                @endif
                                                            </td>
                                                            <td>{{ verta($info->created_at)->format('%d / %B  / %Y') }}</td>
                                                            <td>
                                                                @if($info->status == 1)
                                                                    <label class="custom-switch"
                                                                           wire:click.prevent="statusDisable({{$info->id}})">
                                                                        <input type="checkbox"
                                                                               name="custom-switch-checkbox"
                                                                               class="custom-switch-input"
                                                                               checked="checked">
                                                                        <span class="custom-switch-indicator"></span>
                                                                    </label>
                                                                @else
                                                                    <label class="custom-switch"
                                                                           wire:click.prevent="statusEnable({{$info->id}})">
                                                                        <input type="checkbox"
                                                                               name="custom-switch-checkbox"
                                                                               class="custom-switch-input">
                                                                        <span class="custom-switch-indicator"></span>

                                                                    </label>

                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{route('EditCategory',$info->id)}}"
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
                                    </div>
                                    @if($readyToLoad)
                                        {{$data_info->links()}}
                                    @endif
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
                    <h5>حذف دسته</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف دسته اطمینان دارید؟</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف دسته
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
                    <h5>حذف دسته بندی ها</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف گروهی دسته بندی ها اطمینان دارید؟</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="deleteAll()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف دسته بندی ها
                    </button>
                </div>
            </div>
        </div>
    </div>
    @push('jsPanel')
        <script>
            var checkedData = [];
            $('#tableID').on('page.dt', function () {
                let allIds = localStorage.getItem("row-data-ids").split(",");

                $('.checkboxes:checkbox:checked').each(function (index, rowId) {
                    if ($.inArray($(this).val(), allIds) == -1) {
                        checkedData.push($(this).val());
                    }

                });
                localStorage.setItem('row-data-ids', checkedData);
            });
        </script>
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
</div>



