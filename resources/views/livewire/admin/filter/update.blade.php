@section('title','ویرایش فیلتر')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ویرایش فیلتر</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('Filters')}}">فیلترها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">فیلتر ویرایش</li>
                </ol>

            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.remove>ویرایش
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('Filters')}}" class="btn btn-warning text-white"
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
                        ویرایش فیلتر - {{$filter->title}}
                    </div>
                    <div class="card-body">
                        <form>
                            <div class=" bg-white">
                                <div class="form-group row">
                                    <label class="col-md-2 form-label">عنوان:<span class="tx-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" placeholder="عنوان "
                                               class="form-control @error('title') is-invalid @enderror"
                                               wire:model.lazy="title">
                                        @error('title')
                                        <div class="invalid-feedback display-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-label">انتخاب دسته بندی: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-control" wire:model.lazy="category_id">
                                            <option value="">انتخاب کنید</option>
                                            @foreach($categories as $cat)
                                                <option value="{{$cat->id}}">{{$cat->title}}</option>
                                                @if(\App\Models\Category::where('status',1)->where('parent',$cat->id)->first())
                                                    @foreach(\App\Models\Category::where('status',1)->where('parent',$cat->id)->get() as $subCategory)
                                                        <option value="{{$subCategory->id}}">{{$cat->title}} > {{$subCategory->title}}</option>
                                                        @if(\App\Models\Category::where('status',1)->where('parent',$subCategory->id)->first())
                                                            @foreach(\App\Models\Category::where('status',1)->where('parent',$subCategory->id)->get() as $subCategory1)
                                                                <option value="{{$subCategory1->id}}">{{$cat->title}} > {{$subCategory->title}} > {{$subCategory1->title}}</option>
                                                            @endforeach
                                                        @endif

                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback display-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-label">وضعیت: </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" wire:model.lazy="status">
                                            <option value="0" >غیرفعال</option>
                                            <option value="1">فعال</option>
                                        </select>
                                    </div>
                                </div>
                                @isset($category_id)
                                    @php $attributes=\App\Models\Attribute::where('category_id',$category_id)->get(); @endphp
                                    <div class="form-group row">
                                        <label class="col-md-2 form-label">انتخاب مشخصه: <span class="tx-danger">*</span></label>
                                        <div class="col-10">
                                            <select wire:model.lazy="filter_title" class="form-control">
                                                <option value="">انتخاب</option>
                                                @foreach($attributes as $atts)
                                                    <option value="{{$atts->id}}">{{$atts->title}}</option>
                                                @endforeach
                                            </select>
                                            @error('filter_title')
                                            <div class="invalid-feedback display-block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="tab-attribute">

                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <td>مقدار مشخصه</td>
                                                <td></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($inputFilter as $key => $value)
                                                <tr>
                                                    <td>
                                                        <input wire:model="filter_value.{{$key }}" class="form-control">

                                                    </td>
                                                    <td>
                                                        <button
                                                            class="bbtn ripple btn-secondary text-white btn-icon btn-sm"
                                                            wire:click.prevent="removeFilter({{$key}})"><i
                                                                class="fa fa-minus-circle"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                        <div class=" add-input ">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button class="btn ripple btn-primary text-white btn-icon btn-xs"
                                                            wire:click.prevent="AddFilter({{$i}})"><i
                                                            class="fa fa-plus-circle"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

