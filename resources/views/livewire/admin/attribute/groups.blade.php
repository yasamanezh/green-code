@section('title','مشخصات')
<div class="container-fluid" wire:init="loadCategory">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">مشخصات</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">مشخصات</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a class="btn btn-primary my-2 btn-icon-text" href="{{route('AddAttributeGroup')}}"> افزودن گروه مشخصات
                        <i class="fa fa-plus-circle"></i>
                    </a>
                    <a class="btn btn-primary my-2 btn-icon-text" href="{{route('AddAttribute')}}"> افزودن مشخصه
                        <i class="fa fa-plus-circle"></i>
                    </a>


                </div>
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        مشخصات
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
                            <div id="example2_wrapper" class="">
                                <div class="row">
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
                                    @if($readyToLoad)
                                        @foreach($data_info as $info)
                                    <div class="col-sm-12 ">
                                        <div class="bd mb-2 p-3 rounded-10 " style="width: 100%;">
                                            <a aria-controls="collapseExample" aria-expanded="false"  data-toggle="collapse" href="#collapseExample{{$info->id}}" role="button">{{$info->title}}
                                           || (
                                                @php $category=\App\Models\Category::where('id',$info->category_id)->first();   @endphp
                                                @if(isset($category->parent) && $category->parent !=0 )
                                                    @php
                                                        $firstParet=\App\Models\Category::where('id',$category->parent)->first();
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
                                                        {{$firstParet->title}}  > {{$category->title}}
                                                    @elseif($level==3)
                                                        {{$secondParenttitle->title}}
                                                        >{{$firstParet->title}}  > {{$category->title}}
                                                    @endif
                                                @else
                                                    @php $level=1;  @endphp
                                                    {{$category->title}}
                                                @endif
                                                ) ||
                                                ({{count(\App\Models\Attribute::where('group',$info->id)->get())}})
                                            </a>
                                            <div class="pull-left">
                                                <a href="{{route('EditAttributeGroup',$info->id)}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="" wire:click.prevent="confirmCategoryRemoval({{ $info->id }})" style="color: red" class="mr-3"><i class="fa fa-trash"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                            @foreach(\App\Models\Attribute::where('group',$info->id)->orderBy('sort_order', 'Asc')->get() as $attr)
                                                @if($attr)
                                                    <div class="col-sm-12 collapse" id="collapseExample{{$info->id}}">
                                                        <div class="bd mb-2 p-3 rounded-10" style=";margin-right: 20px">
                                                        <span style="color:#6259ca">{{$attr->title}}</span>
                                                            <div class="pull-left">
                                                                <a href="{{route('EditAttribute',$attr->id)}}">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a href="" href="" wire:click.prevent="confirmAttributeRemoval({{ $attr->id }})" style="color: red" class="mr-3"><i class="fa fa-trash"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
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
                    <h5>حذف گروه مشخصات</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف گروه مشخصات اطمینان دارید؟</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف گروه مشخصات
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
                    <h5>حذف مشخصه</h5>
                </div>
                <div class="modal-body">
                    <h4>برای حذف مشخصه اطمینان دارید؟</h4>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i
                            class="fa fa-times ml-1"></i> انصراف
                    </button>
                    <button type="button" wire:click.prevent="deleteAttr()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>حذف مشخصات
                    </button>
                </div>
            </div>
        </div>
    </div>
    @push('jsPanel')
        <script>
            var checkedData = [];
            $('#tableID').on( 'page.dt', function () {
                let allIds = localStorage.getItem("row-data-ids").split(",");

                $('.checkboxes:checkbox:checked').each(function(index, rowId){
                    if($.inArray( $(this).val(),  allIds) ==  -1){
                        checkedData.push($(this).val());
                    }

                });
                localStorage.setItem('row-data-ids', checkedData);
            } );
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



