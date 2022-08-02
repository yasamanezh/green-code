@section('title','ایمیل ها')
<div class="container-fluid">
    <div class="inner-body" wire:init="loadEmail">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ایمیل ها</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایمیل ها</li>
                </ol>

            </div>
            <div >
                <a class="btn btn-primary text-white my-2 btn-icon-text" href="{{route('AddEmailNotification')}}">افزودن
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>

        </div>

        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
               @include('livewire.admin.layouts.message')
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        ایمیل ها
                        @if(count($deleteItem) >=1 )
                            <span class="float-left">
                                <a href="" wire:click.prevent="confirmAllEmailRemoval()"
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
                                        <th style="width: 200px">عنوان</th>

                                        <th>توضیحات </th>
                                        <th>
                                            تاریخ ایجاد
                                            <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                        </span>
                                        </th>
                                        <th>تاریخ ارسال</th>

                                        <th>عملیات</th>
                                    </tr>
                                    </thead>

                                    @if($readyToLoad)
                                        <tbody>
                                        @foreach($emails as $email)

                                            <tr role="row">
                                                <td>
                                                    <label class="ckbox" >
                                                        <input name="selected" value="{{$email->id}}" wire:model="mulitiSelect" type="checkbox"><span class="tx-13"></span>
                                                    </label>
                                                </td>


                                                <td> {{$email->subject}} </td>
                                                <td> {!! \Illuminate\Support\Str::limit($email->content,30,'...') !!} </td>

                                                <td>{{ verta($email->created_at)->format('%d/ %B  / %Y') }}</td>
                                                <td>
                                                    @if($this->expire($email->date_send,$email->time_send))
                                                        @if($email->status == 1)
                                                            ارسال شده
                                                        @else
                                                            در حال ارسال
                                                        @endif
                                                    @else
                                                        {{$email->date_send}}  -    {{$email->time_send}}

                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('EditEmailNotification',$email->id)}}" class="btn btn-sm btn-info">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <a href="" wire:click.prevent="confirmEmailRemoval({{ $email->id }})" class="btn btn-sm btn-danger">
                                                        <i class="fe fe-trash"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        {{$emails->render()}}
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
    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>حذف ایمیل</h5>
                </div>

                <div class="modal-body">
                    <h4>برای حذف ایمیل اطمینان دارید؟</h4>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button"  wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف ایمیل
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
                    <h5>حذف ایمیل ها</h5>
                </div>

                <div class="modal-body">
                    <h4>برای حذف گروهی ایمیل ها اطمینان دارید؟</h4>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button"  wire:click.prevent="deleteAll()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف ایمیل ها
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@push('jsPanel')
    <script>

        $(document).ready(function() {
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



