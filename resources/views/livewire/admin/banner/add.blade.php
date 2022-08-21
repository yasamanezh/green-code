@section('title',' ایجاد بنر جدید')
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5"> ایجاد بنر جدید</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                        <li class="breadcrumb-item"><a href="{{route('banner.index')}}">بنرها</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> ایجاد بنر جدید</li>
                    </ol>
                </div>
                <div>
                    <button wire:click.prevent="saveInfo" class="btn btn-primary" wire:loading.attr="disabled"
                            wire:loading.remove>ذخیره
                    </button>
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
            <div class="row">
                <div class="col-12 ">
                    <div class="card custom-card">
                        <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                            ایجاد بنر جدید
                        </div>
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <form enctype="multipart/form-data" role="form" class="padding-10 categoryForm">
                                    <div class="form-group row">
                                        <div class="form-label col-2">تصویر:<span class="tx-danger">*</span></div>
                                        <div class="col-10">
                                            @if($img)
                                                <img class="form-control" src="{{$img->temporaryUrl()}}"
                                                     style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;"
                                                     id="picture">
                                            @else
                                                <img src="{{ asset('assets/uploadicon.png')}}"
                                                     style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;"
                                                     id="picture">
                                            @endif
                                            <br>
                                            <input type="file" wire:model.defer="img" class="form-control col-8"
                                                   style="display:none" id="fileinput">
                                            <span class="mt-2 text-danger" wire:loading wire:target="img">در حال آپلود ...</span>
                                            @error('img')
                                            <div class="invalid-feedback display-block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label col-sm-2">عنوان :<span
                                                    class="tx-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" wire:model.defer="banner.title" placeholder="نام بنر "
                                                   class="form-control @error('banner.title') is-invalid @enderror">
                                            @error('banner.title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label col-sm-2">ارتفاع :</label>
                                        <div class="col-sm-10">
                                            <input type="text" wire:model.defer="banner.height"
                                                   placeholder="ارتفاع بنر "
                                                   class="form-control @error('banner.height') is-invalid @enderror">
                                            @error('banner.height')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label col-sm-2">استایل</label>
                                        <div class="col-sm-10">
                                            <select type="text" wire:model.defer="banner.style" placeholder="نام بنر "
                                                    class="form-control">
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
                                    </div>
                                    <div class="form-group row">
                                        <label class="form-label col-sm-2">لینک :</label>
                                        <div class="col-sm-10">
                                            <input type="text" wire:model.defer="banner.link" placeholder="لینک بنر "
                                                   class="form-control @error('banner.link') is-invalid @enderror">
                                            @error('banner.link')
                                            <div class="invalid-feedback display-block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
