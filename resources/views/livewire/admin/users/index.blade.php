@section('title','کاربران')
<div class="container-fluid" wire:init="loadUser">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">فهرست کاربران</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">فهرست کاربران</li>
                </ol>
            </div>
            <div>
                <a class="btn btn-primary my-2 btn-icon-text" href="{{route('AddUser')}}">افزودن
                    <i class="fa fa-plus-circle"></i>
                </a>

                <button wire:click.prevent="export" class="btn btn-primary my-2 btn-icon-text">
                    خروجی اکسل<i class="fe fe-download-cloud ml-0"></i>
                </button>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        کاربران
                        @if(count($deleteItem) >=1 )
                            <span class="float-left">
                                <a href="" wire:click.prevent="confirmAllRemoval()" class="btn btn-sm btn-danger">حذف ({{count($deleteItem)}})</a>
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
                                <tr>
                                    <th style="padding-right: 15px;" class="wd-lg-5p">
                                        <label class="ckbox">
                                            <input name="selected" wire:model="SelectPage"
                                                   type="checkbox"><span
                                                class="tx-13"></span>
                                        </label>
                                    </th>
                                    <th class="wd-lg-20p"><span>کاربر</span>
                                        <span wire:click="sortBy('name')" class="float-right text-sm"
                                              style="cursor: pointer;">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                    </th>
                                    <th class="wd-lg-20p"><span>تاریخ ثبت نام</span></th>
                                    <th class="wd-lg-20p" scope="col">نقش کاربر</th>
                                    <th class="wd-lg-20p" scope="col">دسترسی</th>
                                    <th class="wd-lg-5p">عملیات</th>
                                </tr>
                                </thead>
                                @if($readyToLoad)
                                    <tbody>
                                    @foreach($users as $index => $user)
                                        <tr>
                                            <td>
                                                <label class="ckbox">
                                                    <input name="selected" value="{{$user->id}}"
                                                           wire:model="mulitiSelect" type="checkbox"><span
                                                        class="tx-13"></span>
                                                </label>
                                            </td>

                                            <td>
                                                {{$user->name}}
                                            </td>
                                            <td>{{ verta($user->created_at)->format('%d %B ، %Y') }}</td>
                                            <td>
                                                <select class="form-control"
                                                        wire:change="changeRole({{ $user }}, $event.target.value)">
                                                    <option
                                                        value="admin" {{ ($user->role === 'admin') ? 'selected' : '' }}>
                                                        ادمین سایت
                                                    </option>
                                                    <option
                                                        value="hamkar" {{ ($user->role === 'hamkar') ? 'selected' : '' }}>
                                                        همکار سایت
                                                    </option>
                                                    <option
                                                        value="user" {{ ($user->role === 'user') ? 'selected' : '' }}>
                                                        کاربر سایت
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                @if($user->role=='hamkar')
                                                    @foreach($user->roles as $role)
                                                        <span class="badge badge-info">{{$role->label}}</span>
                                                    @endforeach
                                                @elseif(($user->role=='user'))
                                                    <span class="badge badge-light">کاربر سایت</span>
                                                @else
                                                    <span class="badge badge-primary">ادمین</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('EditUser',$user->id)}}" class="btn btn-sm btn-info">
                                                    <i class="fe fe-edit-2"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-danger"
                                                   wire:click.prevent="confirmUserRemoval({{ $user->id }})">
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
                        @if($readyToLoad)
                            {{ $users->links() }}
                        @endif
                    </div>
                </div>
            </div><!-- COL END -->
        </div>
        <!-- row closed  -->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>حذف کاربر</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف کاربر اطمینان دارید؟</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف کاربر
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
                    <h5>حذف کاربر ها</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف گروهی کاربر ها اطمینان دارید؟</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="deleteAll()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف کاربر ها
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@push('jsPanel')
    <script>

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

        window.addEventListener('hide-form', event => {
            $('#form').modal('hide');
        })

        window.addEventListener('show-form', event => {
            $('#form').modal('show');
        })
    </script>
@endpush
