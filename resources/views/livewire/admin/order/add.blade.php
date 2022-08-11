<div>
    @section('title','افزودن صورتحساب')
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">افزودن html</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.orders.index')}}">سفارشات</a></li>
                        <li class="breadcrumb-item active" aria-current="page">افزودن سفارش</li>
                    </ol>
                </div>
                <div>
                    <button wire:click.prevent="saveInfo" wire:loading.remove id="submit" type="submit"
                            class="btn btn-primary">ذخیره
                    </button>
                    <div wire:loading wire:target="saveInfo">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    <a data-toggle="tooltip" href="{{route('admin.orders.index')}}" class="btn btn-warning text-white"
                       data-original-title="برگشت">
                        <i class="fa fa-backward"></i>
                    </a>
                </div>
            </div>
            @include('livewire.admin.layouts.error')
            <form id="form-product" class="form-horizontal">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card custom-card ">
                            <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                                  افزودن سفارش
                            </div>
                            <div class="card-body border">
                                <div id="tab-general">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <label class="form-label col-sm-2">عنوان: <span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('title') parsley-error @enderror"
                                                       wire:model.defer="title">
                                                @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <label class="form-label col-sm-2">قیمت: <span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('prices') parsley-error @enderror"
                                                       wire:model.defer="prices">
                                                @error('prices')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <label class="form-label col-sm-2">تخفیف: </label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('discount') parsley-error @enderror"
                                                       wire:model.defer="discount">
                                                @error('discount')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <label class="form-label col-sm-2">کاربر: <span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <select class="form-control "  wire:model.defer="user">
                                                    <option value="">انتخاب</option>
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('user')
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
            </form>
        </div>
    </div>
    </div>

