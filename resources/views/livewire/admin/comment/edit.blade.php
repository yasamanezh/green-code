@section('title','ویرایش پرسش')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ویرایش پرسش</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('Coments')}}">دیدگاهها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش پرسش</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="updateInfo()" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.attr="disabled" wire:loading.remove>ویرایش
                </button>
                <div wire:loading wire:target="updateInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('Coments')}}" class="btn btn-warning text-white"
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
                        ویرایش پرسش
                    </div>
                    <div class="card-body">
                        <form>
                            <div>
                                <div class="form-group row">
                                    <label class="col-md-2">پرسش:</label>
                                    <div class="col-md-10">
                                        <textarea type="text" name="slug" rows="10"
                                                  class="form-control @error('comment.content') is-invalid @enderror"
                                                  wire:model.defer="comment.content"></textarea>
                                        @error('comment.content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">پاسخ:</label>
                                    <div class="col-md-10">
                                        <textarea type="text" rows="10" name="slug"
                                                  class="form-control @error('comment.answer') is-invalid @enderror"
                                                  wire:model.defer="comment.answer"></textarea>
                                        @error('comment.answer')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">وضعیت</div>
                                    <div class="col-sm-10">
                                        <select class="form-control" wire:model="comment.status" name="status">
                                            <option value="1">فعال</option>
                                            <option value="0">غیر فعال</option>
                                        </select>
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

