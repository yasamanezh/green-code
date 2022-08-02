@section('title','ویرایش مقام')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ویرایش مقام</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('Roles')}}">مقام ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش مقام</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" wire:loading.remove class="btn btn-primary my-2 btn-icon-text" type="submit" wire:loading.attr="disabled">ذخیره</button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('Roles')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        افزودن مقام
                    </div>
                    <div class="card-body">
                        <form  >
                            <div class="form-group row">
                                <label class="col-md-2">عنوان: </label>
                                <div class="col-md-10">
                                    <input type="text" name="title" placeholder="نام مقام "  class="form-control @error('role.name') is-invalid @enderror"  wire:model.defer="role.name">
                                    @error('role.name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">توضیحات: </label>
                                <div class="col-md-10">
                                    <input type="text" name="label" placeholder="توضیحات "  class="form-control @error('role.label') is-invalid @enderror"  wire:model.defer="role.label">
                                    @error('role.label')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">اجازه دسترسی :</label>
                                <div class="col-sm-10">
                                    <div class="well well-sm scrollbar" id="style-1"
                                         style="height: 150px; overflow: auto;background-color: #f5f5f5;;padding: 20px;direction: rtl">
                                        <div class="checkbox">
                                            <label>
                                                <input wire:model="SelectShow" type="checkbox"> انتخاب همه
                                            </label>

                                        </div>
                                        @foreach($showPermissions as $permission)
                                            <div class="checkbox">
                                                <label>
                                                    <input wire:model.defer="shows" type="checkbox" checked=""
                                                           value="{{$permission->id}}"> {{$permission->description}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">اجازه ویرایش :</label>
                                <div class="col-sm-10">
                                    <div class="well well-sm scrollbar" id="style-1" style="height: 150px; overflow: auto;background-color: #f5f5f5;;padding: 20px;direction: rtl">
                                        <div class="checkbox">
                                            <label>
                                                <input wire:model="SelectEdit" type="checkbox"> انتخاب همه
                                            </label>

                                        </div>
                                        @foreach($editPermissions as $permission)
                                            <div class="checkbox">
                                                <label> <input wire:model.defer="edits" type="checkbox"
                                                               value="{{$permission->id}}"> {{$permission->description}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">اجازه حذف :</label>
                                <div class="col-sm-10">
                                    <div class="well well-sm scrollbar" id="style-1"
                                         style="height: 150px; overflow: auto;background-color: #f5f5f5;;padding: 20px;direction: rtl">
                                        <div class="checkbox">
                                            <label>
                                                <input wire:model="SelectDelete" type="checkbox"> انتخاب همه
                                            </label>

                                        </div>
                                        @foreach($deletePermissions as $permission)
                                            <div class="checkbox">
                                                <label> <input wire:model.defer="delets" type="checkbox"
                                                               value="{{$permission->id}}"> {{$permission->description}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

