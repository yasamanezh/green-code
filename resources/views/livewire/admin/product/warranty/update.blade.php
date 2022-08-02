@section('title','آپدیت گارانتی')

<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">آپدیت گارانتی</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبرد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('warrantys')}}">گارانتی ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش گارانتی</li>
                </ol>
            </div>
            <div wire:ignore>
                <button id="submit" class="btn btn-primary" wire:click.prevent="saveInfo"  wire:loading.remove>ویرایش</button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('warrantys')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <form id="form-product" class="form-horizontal">
            <div class="row">
                <div class="col-xl-12">
                    <div class="main-content-left-components">
                        <div class="card custom-card">
                            <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                                ویرایش گارانتی - {{$warranty->name}}

                            </div>
                            <div class="card-body component-item " id="collapseGeneral" wire:ignore.self>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="col-sm-2 form-label">نام گارانتی : <span
                                                class="tx-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" wire:model.defer="warranty.name"
                                                   placeholder="نام گارانتی " class="form-control">
                                            @error('warranty.name')
                                            <div class="invalid-feedback" style="display: block !important">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">وضعیت:</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" wire:model.defer="warranty.status">
                                            <option value="1">فعال</option>
                                            <option value="0">غیر فعال</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
