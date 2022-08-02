@section('title','ویرایش دیدگاه')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ویرایش دیدگاه</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('ProductComment')}}">دیدگاه محصولات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش دیدگاه</li>
                </ol>
            </div>
            <div>
                <button form="form" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.remove>ویرایش
                </button>
                <div wire:loading wire:target="saveComment">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('ProductComment')}}" class="btn btn-warning text-white"
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
                        ویرایش دیدگاه - {{$productComment->title}}
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveComment" id="form">
                            <div>
                                <div class="form-group row">
                                    <label class="col-md-2">عنوان:</label>
                                    <div class="col-md-10">
                                        <input type="text" name="slug"
                                               class="form-control @error('productComment.title') is-invalid @enderror"
                                               wire:model.defer="productComment.title">
                                        @error('productComment.title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">توضیحات:</label>
                                    <div class="col-md-10">
                                        <textarea type="text" name="slug" rows="10"
                                                  class="form-control @error('productComment.content') is-invalid @enderror"
                                                  wire:model.defer="productComment.content"></textarea>
                                        @error('productComment.content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row form-group">
                                    <div class="col-sm-2">
                                        <span>نقاط قوت</span>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="comments-evaluation">
                                            <div class="comments-evaluation-positive">
                                                <ul style="margin-right: -16px;">
                                                    @if($positives)
                                                        @foreach($positives as $key1 => $value)
                                                            <li>
                                                                <i style="color: red" class="fa fa-minus-circle"
                                                                   wire:click.prevent="removePositive({{$key1}})"></i>
                                                                {{$value}}
                                                            </li>
                                                        @endforeach
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-10">
                                        <input wire:model="positive" class="form-control"
                                               style="margin-top: 16px">

                                    @error('positive')
                                    <span style="color:red">{{$message}}</span>
                                    @enderror
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <button style="margin-top: 15px;"
                                                class="btn ripple btn-primary text-white btn-icon btn-xs"
                                                wire:click.prevent="AddPositive({{$i}})"><i
                                                class="fa fa-plus-circle"></i></button>

                                    </div>
                                </div>
                                <hr>
                                <div class="row form-group">
                                    <div class="col-lg-2">
                                        <span>نقاط ضعف</span>
                                    </div>
                                    <div class="col-10">
                                        <div class="comments-evaluation">
                                            <div class="comments-evaluation-positive">
                                                <ul style="margin-right: -16px;">
                                                    @if($negetives)
                                                        @foreach($negetives as $key=>$negetiveValue)
                                                            <li>
                                                                <i style="color: red" class="fa fa-minus-circle"
                                                                   wire:click.prevent="removeNegetives({{$key}})"></i>
                                                                {{$negetiveValue}}
                                                            </li>
                                                        @endforeach
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-10">
                                        <input wire:model="negetive" class="form-control"
                                               style="margin-top: 16px">

                                        @error('negetive')
                                        <span style="color:red">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 col-sm-2">
                                        <button style="margin-top: 15px"
                                                class="btn ripple btn-primary text-white btn-icon btn-xs"
                                                wire:click.prevent="AddNegetives({{$j}})"><i
                                                class="fa fa-plus-circle"></i></button>

                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <div class="col-sm-2">توصیه</div>
                                    <div class="col-sm-10">
                                        <select class="form-control" wire:model="productComment.is_advice">
                                            <option value="1">بله</option>
                                            <option value="0">خیر</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">وضعیت</div>
                                    <div class="col-sm-10">
                                        <select class="form-control" wire:model="productComment.status">
                                            <option value="1">فعال</option>
                                            <option value="0">غیر فعال</option>
                                        </select>
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

