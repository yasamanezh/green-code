@section('title','ایجاد لایسنس')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ایجاد لایسنس</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('Licences')}}">لایسنسها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد لایسنس</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.attr="disabled" wire:loading.remove>ذخیره
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('Licences')}}" class="btn btn-warning text-white"
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
                        افزودن لایسنس
                    </div>
                    <div class="card-body">
                        <form>
                            <div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-label">آدرس سایت: <span class="tx-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" name="title" placeholder="آدرس سایت "
                                               class="form-control @error('licence.url') is-invalid @enderror"
                                               wire:model.defer="licence.url">
                                        @error('licence.url')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-label">لایسنس:<span class="tx-danger"> * </span></label>
                                    <div class="col-md-10">

                                        <input type="text" class="form-control @error('licence.licence') is-invalid @enderror"
                                               wire:model.defer="licence.licence">
                                        @error('licence.licence')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2"> وضعیت:</label>
                                        <div class="col-sm-10">
                                            <select wire:model="licence.status"
                                                    class="form-control
                                           @error('licence.status') is-invalid @enderror">
                                                <option value="0">غیر فعال</option>
                                                <option value="1"> فعال</option>

                                            </select>
                                            @error('licence.status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
