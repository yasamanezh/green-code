@section('title','خبرنامه سایت')
<div class="container-fluid">
    <div class="inner-body" wire:init="loadNewsatter">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">خبرنامه ها</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">خبرنامه سایت</li>
                </ol>

            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <button wire:click.prevent="export" class="btn btn-primary my-2 btn-icon-text">
                        خروجی اکسل<i class="fe fe-download-cloud ml-0"></i>
                    </button>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-8 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        خبرنامه
                        @if(count($deleteItem) >=1 )
                            <span class="float-left">
                                <a href="" wire:click.prevent="confirmAllRemoval()" class="btn btn-sm btn-danger">
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
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-6" style="margin-top: 10px">تعداد نمایش :</label>
                                            <div class="col-sm-6">
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
                                    <div class="col-sm-6">
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
                                <table class="table dataTable no-footer dtr-inline " id="example2"
                                       role="grid" aria-describedby="example2_info">

                                    <thead role="rowgroup">
                                    <tr role="row" class="title-row">
                                        <th style="padding-right: 15px;" class="wd-lg-5p">
                                            <label class="ckbox">
                                                <input name="selected" wire:model="SelectPage"
                                                       type="checkbox"><span
                                                    class="tx-13"></span>
                                            </label>
                                        </th>
                                        <th>ایمیل خبرنامه</th>
                                        <th class="wd-lg-20p"><span>تاریخ ثبت نام</span></th>
                                        <th>عملیات</th>
                                    </tr>
                                    </thead>

                                    @if($readyToLoad)
                                        <tbody>
                                        @foreach($newsletters as $newsletter)
                                            <tr role="row">
                                                <td>
                                                    <label class="ckbox">
                                                        <input name="selected" value="{{$newsletter->id}}"
                                                               wire:model="mulitiSelect" type="checkbox"><span
                                                            class="tx-13"></span>
                                                    </label>
                                                </td>

                                                <td><a href="">{{$newsletter->email}}</a></td>
                                                <td>{{ verta($newsletter->created_at)->format('%d %B ، %Y') }}</td>
                                                <td>

                                                    <a href="#" class="btn btn-sm btn-danger"
                                                       wire:click.prevent="confirmRemoval({{ $newsletter->id }})">
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
                                {{ $newsletters->links() }}
                            @endif
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-sm-4">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        ایجاد خبر نامه جدید
                    </div>
                    <div class="card-body">

                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">


                            <form wire:submit.prevent="categoryForm"
                                  enctype="multipart/form-data" role="form"
                                  class="padding-10 categoryForm">

                                <div class="form-group">
                                    <input style="text-align: right;" wire:model.lazy="newsletter.email"
                                           placeholder="ایمیل خبرنامه "
                                           class="form-control">
                                </div>
                                @error('newsletter.email')
                                <div class="invalid-feedback display-block">
                                    {{ $message }}
                                </div>
                                @enderror

                                <button class="btn btn-primary text-white">افزودن خبرنامه</button>
                            </form>
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
                    <h5>حذف خبرنامه</h5>
                </div>

                <div class="modal-body">
                    <h4>برای حذف خبرنامه اطمینان دارید؟</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف خبرنامه
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
                    <h5>حذف خبرنامه ها</h5>
                </div>

                <div class="modal-body">
                    <h4>برای حذف گروهی خبرنامه ها اطمینان دارید؟</h4>

                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button"  wire:click.prevent="deleteAll()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف خبرنامه ها
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

