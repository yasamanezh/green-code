@section('title','سطل زباله دسته بندی محصولات')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">سطل زباله دسته بندی ها</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('categories')}}">دسته بندی ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$data['breadcrumbs_text']}}</li>
                </ol>

            </div>
            <a data-toggle="tooltip" href="{{route('categories')}}" class="btn btn-warning text-white"
               data-original-title="برگشت">
                <i class="fa fa-backward"></i>
            </a>
        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">{{$data['breadcrumbs_text']}}</div>
                    <div class="card-body">
                        <div class="table-responsive">
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
                                        <table class="table dataTable no-footer dtr-inline collapsed" id="example2"
                                               role="grid" aria-describedby="example2_info" >
                                        <thead>
                                        <tr role="row">
                                            <th class="wd-lg-5p">تصویر  </th>
                                            <th>عنوان </th>
                                            <th class="wd-lg-5p">عملیات </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data_info as $info)
                                            <tr role="row" >
                                                <td><img src="/storage/{{$info->img}} " style="width: 40px;height: 40px"></td>
                                                <td>
                                                    {{$info->title}}
                                                </td>

                                                <td>

                                                    <div class="btn-icon-list">
                                                        <a wire:click.prevent="trashedCategory({{$info->id}})" class="btn btn-sm btn-info text-white">
                                                            <i class="fa fa-history"></i>
                                                        </a>
                                                        <a href="" wire:click.prevent="confirmCategoryRemoval({{ $info->id }})" class="btn btn-sm btn-danger text-white">
                                                            <i class="fe fe-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                    {{$data_info->links()}}
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
                        <h4>برای حذف دسته  اطمینان دارید؟</h4>

                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button"  wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف دسته
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@push('jsPanel')
    <script>

        window.addEventListener('show-delete-modal', event => {
            $('#confirmationModal').modal('show');
        })

        window.addEventListener('hide-delete-modal', event => {
            $('#confirmationModal').modal('hide');
            toastr.success(event.detail.message, 'Success!');
        })
    </script>
@endpush

