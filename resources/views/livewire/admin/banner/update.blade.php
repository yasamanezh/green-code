@section('title','آپدیت بنر')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">آپدیت بنر</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('banner.index')}}">بنرها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش بنر
                    </li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary"  wire:loading.attr="disabled" wire:loading.remove>ذخیره</button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('banner.index')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <div class="row ">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">ویرایش -
                        {{$banner->title}}
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div>
                                @include('errors.error')
                                <div class="form-group row">
                                    <div class="col-sm-2 form-label">تصویر:<span class="tx-danger">*</span></div>
                                    <div class="col-sm-10">
                                        <br>
                                        @if($UpdatedPhoto)
                                            <img src="{{ $UpdatedPhoto->temporaryUrl() }}" id="picture"  style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;">
                                        @elseif($img)
                                            <div>
                                                <img src="{{ asset('storage/'.$img) }}" id="picture"
                                                     style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;">
                                            </div>
                                        @endif
                                        <br>
                                        <input name="UpdatedPhoto" style="display:none" id="fileinput" type="file"
                                               wire:model.defer="UpdatedPhoto" class="hidden"/>
                                        <span class="mt-2 text-danger" wire:loading wire:target="UpdatedPhoto">در حال آپلود ...</span>
                                        @error('UpdatedPhoto')
                                        <div class="invalid-feedback display-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 form-label">عنوان:<span class="tx-danger">*</span></label>
                                    <input type="text" wire:model.defer="banner.title" placeholder="عنوان"
                                           class="form-control col-sm-10  @error('banner.title') is-invalid @enderror">
                                    @error('banner.title')
                                    <div class="invalid-feedback  display-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">ارتفاع :</label>
                                    <div class="col-sm-10">
                                        <input type="text" wire:model.defer="banner.height" placeholder="ارتفاع بنر "
                                               class="form-control @error('banner.height') is-invalid @enderror">
                                        @error('banner.height')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">استایل:</label>
                                    <select type="text" wire:model.defer="banner.style" placeholder="نام بنر "
                                            class="form-control col-sm-10">
                                        <option value="">انتخاب</option>
                                        <option value="banners-effect-1">استایل1</option>
                                        <option value="banners-effect-2">استایل2</option>
                                        <option value="banners-effect-3">استایل3</option>
                                        <option value="banners-effect-4">استایل4</option>
                                        <option value="banners-effect-5">استایل5</option>
                                        <option value="banners-effect-6">استایل6</option>
                                        <option value="banners-effect-7">استایل7</option>
                                        <option value="banners-effect-8">استایل8</option>
                                        <option value="banners-effect-9">استایل9</option>
                                        <option value="banners-effect-10">استایل10</option>
                                        <option value="banners-effect-11">استایل11</option>
                                        <option value="banners-effect-12">استایل12</option>
                                    </select>

                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">لینک : </label>
                                    <input type="text" wire:model.defer="banner.link" placeholder="لینک  "
                                           class="form-control col-sm-10 @error('banner.link') is-invalid @enderror">
                                    @error('banner.link')
                                    <div class="invalid-feedback display-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
