@section('title','ویرایش برند')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ویرایش برند</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('Manufacturers')}}">برندها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش برند</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.remove>ویرایش
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('Manufacturers')}}" class="btn btn-warning text-white"
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
                        ویرایش برند - {{$title}}
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2  form-label">تصویر :<span class="tx-danger">*</span></label>
                            <div class="col-sm-10">
                                <br>
                                @if($UpdatedPhoto)
                                    <img src="{{ $UpdatedPhoto->temporaryUrl() }}"
                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                         id="picture">
                                @elseif($img)
                                    <img src="{{ asset('storage/'.$img) }}"
                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                         id="picture">
                                @else
                                    <img src="{{ asset('assets/uploadicon.png')}}"
                                        style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                    id="picture" >
                                @endif
                                <input name="UpdatedPhoto" type="file" wire:model.defer="UpdatedPhoto"
                                       style="display:none" id="fileinput" accept="image/*">
                                <span class="mt-2 text-danger" wire:loading
                                      wire:target="UpdatedPhoto">در حال آپلود ...</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label col-sm-2">عنوان: <span class="tx-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="title"
                                       class="form-control @error('title') is-invalid @enderror"
                                       wire:model.defer="title">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-label"> لینک :<span class="tx-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                                       wire:model.defer="slug">
                                @error('slug')
                                <div class="invalid-feedback">
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

