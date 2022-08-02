@section('title','ایجاد دسته')
@if(isset($result))
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">ایجاد دسته</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                        <li class="breadcrumb-item"><a href="{{route('categories')}}">دسته بندی</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ایجاد دسته</li>
                    </ol>
                </div>
                <div>
                    <a data-toggle="tooltip" href="{{route('categories')}}" class="btn btn-warning text-white"
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
                            ایجاد دسته
                        </div>
                        <div class="card-body">
                            {!! $result !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">ایجاد دسته</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                        <li class="breadcrumb-item"><a href="{{route('categories')}}">دسته بندی</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ایجاد دسته</li>
                    </ol>
                </div>
                <div>
                    <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                            wire:loading.remove>ذخیره
                    </button>
                    <div wire:loading wire:target="saveInfo">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    <a data-toggle="tooltip" href="{{route('categories')}}" class="btn btn-warning text-white"
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
                            ایجاد دسته
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 form-label">تصویر: <span class="tx-danger">*</span></label>
                                <div class="col-sm-10">
                                    <br>
                                    @if($img)
                                        <img src="{{ $img->temporaryUrl() }}"
                                             style="width: 100px;height:100px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                             id="picture">
                                    @else
                                        <img id="picture"
                                             style="width: 100px;height:100px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                             src="{{ asset('assets/uploadicon.png')}}">
                                    @endif
                                    <br> <br>
                                    <input name="img" type="file" wire:model.defer="img" style="display:none"
                                           id="fileinput" accept="image/*">
                                    @error('img')
                                    <div class="invalid-feedback display-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <span class="mt-2 text-danger" wire:loading
                                          wire:target="img">در حال آپلود ...</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-label"> عنوان: <span class="tx-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" name="title" placeholder="نام دسته "
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
                                <label class="col-md-2 form-label"> لینک: <span class="tx-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" name="slug" placeholder="لینک "
                                           class="form-control @error('slug') is-invalid @enderror"
                                           wire:model.defer="slug">
                                    @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class=" col-md-2 form-label">سردسته:</label>
                                <div class="col-md-10">
                                    <select wire:model.defer="parent"
                                            class="form-control @error('parent') is-invalid @enderror">
                                        <option value="0">بدون دسته</option>
                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                            @if(\App\Models\Category::where('status',1)->where('parent',$cat->id)->first())
                                                @foreach(\App\Models\Category::where('status',1)->where('parent',$cat->id)->get() as $subCategory)
                                                    <option value="{{$subCategory->id}}">{{$cat->title}}
                                                        > {{$subCategory->title}}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('parent')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row row-sm">
                                    <label class="form-label col-sm-2">متا تگ توضیحات: </label>
                                    <div class="col-sm-10">
                                    <textarea wire:model="meta_description"
                                              name="meta_description" rows="5"
                                              placeholder="متا تگ توضیحات" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row row-sm">
                                    <label class="form-label col-sm-2">متا تگ کلمات کلیدی: </label>
                                    <div class="col-sm-10">
                                    <textarea wire:model="meta_keyword" name="meta_keyword"
                                              rows="5" placeholder="متا تگ کلمات کلیدی"
                                              class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row row-sm" wire:ignore>
                                    <label class="col-sm-2 form-label">متا تگ عنوان:</label>
                                    <div class="col-sm-10">
                                        <input type="text" wire:model="meta_title" value=""
                                               placeholder="متا تگ عنوان" name="meta_title"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 form-label">وضعیت:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" wire:model="status" name="status">
                                        <option value="">انتخاب کنید</option>
                                        <option value="1">فعال</option>
                                        <option value="0">غیر فعال</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif