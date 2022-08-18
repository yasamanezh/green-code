<div>
@section('title','ویرایش کالا')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ویرایش کالا</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('Products')}}">محصولات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش کالا</li>
                </ol>
            </div>
            <div wire:ignore>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit" id="submit"
                        wire:loading.remove>ویرایش
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('Products')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <ul class="item1-links nav nav-tabs  mb-0">
                        <li class="nav-item">
                            <a wire:ignore data-target="#general" class="nav-link active" data-toggle="tab"
                               role="tablist" style="cursor: pointer;"> عمومی</a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-seo" class="nav-link " data-toggle="tab" role="tablist"
                               style="cursor: pointer;">سئو</a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#links" class="nav-link " data-toggle="tab" role="tablist"
                               style="cursor: pointer;"> لینک ها</a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#attribute" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">مشخصات</a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#NaghdOption" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">نقد و بررسی</a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-attribute" class="nav-link" data-toggle="tab"
                               role="tablist" style="cursor: pointer;">ویژگی ها</a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-download" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">دانلودها</a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-image" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">تصاویر</a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-option" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">گزینه ها</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        ویرایش محصول
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="tab-content" id="myTabContent">
                                <div wire:ignore.self class="tab-pane fade show active" id="general" role="tabpanel">
                                    <div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <label class="form-label col-sm-2">عنوان: <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" wire:model.defer="product.title"
                                                           name="product.title"
                                                           value="" placeholder="عنوان محصول" id="input-name1"
                                                           class="form-control @error('product.title') parsley-error @enderror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <label class="form-label col-sm-2">دمو: </label>
                                                <div class="col-sm-10">
                                                    <input type="text" wire:model.defer="product.demo"
                                                           name="product.demo"
                                                           value="" placeholder="ادرس دمو"
                                                           id="input-name1"
                                                           class="form-control @error('product.demo') parsley-error @enderror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <label class="form-label col-sm-2">قیمت: <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-sm-10">

                                                    <input type="text" wire:model.defer="product.price"
                                                           name="product.price"
                                                           value="" placeholder="قیمت" id="input-price"
                                                           class="form-control @error('product.price') parsley-error @enderror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <label class="form-label col-sm-2">در صد تخفیف: </label>
                                                <div class="col-sm-10">

                                                    <input type="number" min="0" max="100" wire:model.defer="product.sell"
                                                           name="product.sell"
                                                           placeholder="در صد تخفیف" id="input-price"
                                                           class="form-control @error('product.sell') parsley-error @enderror">

                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row row-sm">
                                                <label class="form-label col-sm-2">لینک: <span
                                                        class="tx-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    <input type="text" wire:model.defer="product.slug" value=""
                                                           placeholder="لینک" name="product.slug"
                                                           class="form-control @error('product.slug') parsley-error @enderror">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <label class="form-label col-sm-2">دارای لایسنس: </label>
                                                <div class="col-md-10 " wire:ignore>
                                                    <select id="manufacturer" class="form-control"
                                                            wire:model.lazy="product.manufacturer">
                                                        <option value="1">بله</option>
                                                        <option value="0">خیر</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <label class="form-label col-sm-2">وضعیت: </label>
                                                <div class="col-sm-10">
                                                    <select wire:model="product.status" name="product.status"
                                                            class="form-control">
                                                        <option value="1">فعال</option>
                                                        <option value="0">غیرفعال</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <label class="form-label col-sm-2">پشتیبانی(روز): </label>
                                                <div class="col-sm-10">
                                                    <input wire:model.defer="product.warrenty"
                                                           class="form-control" placeholder="مثلا 30">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="message" class="col-sm-2 form-label">توضیحات:<span
                                                    class="ml-2 text-danger">*</span></label>
                                            <div class="col-sm-10" wire:ignore>
                                                <textarea rows="10" id="summernote-editor"
                                                          class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                          name="message" wire:model="product.description"
                                                          autocomplete="off">
                                                     {{$product->description}}
                                                </textarea>
                                                @if ($errors->has('message'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane" id="tab-seo" role="tabpanel">
                                    <div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <label class="form-label col-sm-2">متا توضیحات: </label>

                                                <div class="col-sm-10">
                                            <textarea wire:model="product.meta_description"
                                                      name="product.meta_description" rows="5"
                                                      placeholder="متا تگ توضیحات" class="form-control"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm">
                                                <label class="form-label col-sm-2">متا کلمات کلیدی: </label>


                                                <div class="col-sm-10">
                                            <textarea wire:model="product.meta_keyword" name="product.meta_keyword"
                                                      rows="5" placeholder="متا تگ کلمات کلیدی"
                                                      class="form-control"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-sm" wire:ignore>
                                                <label class="col-sm-2 form-label">متا تگ عنوان</label>
                                                <div class="col-sm-10">
                                                    <input type="text" wire:model="product.meta_title" value=""
                                                           placeholder="متا تگ عنوان" name="product.meta_title"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane " id="links" role="tabpanel">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <label class="col-sm-2 form-label">دسته بندی: <span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="showcategories"
                                                        wire:model.lazy="product.category">
                                                    <option selecte="selected">انتخاب</option>
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <label class="col-sm-2 form-label">محصولات مرتبط: </label>
                                            <div class="col-md-10">
                                                <x-inputs.select2 wire:model.defer="showproducts" id="showproducts"
                                                                  placeholder=" انتخاب محصولات مرتبط">
                                                    @foreach ($products as $key => $value)
                                                        <option value="{{ $value->id }}">
                                                            {{ $value->title }}
                                                        </option>
                                                    @endforeach
                                                </x-inputs.select2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane" id="attribute" role="tabpanel">
                                    @if(! isset($product->category))
                                        <div class="alert alert-warning" role="alert">
                                            <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                                            <span class="alert-inner--text"><strong>اخطار !</strong> برای تعیین مشخصات ابتدا دسته بندی را انتخاب کنید.</span>
                                        </div>
                                    @endif

                                    <div class="table-responsive scrollbar" id="style-1">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <td>مشخصه</td>
                                                <td>مقدار</td>
                                                <td>واحد / پسوند</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @isset($product->category)
                                                @php $productAttr=\App\Models\Attribute::where('category_id',$product->category)->get();@endphp
                                                @foreach($productAttr as $key => $value)
                                                    <tr>
                                                        <td>
                                                            <div class="wd-200">
                                                                <input class="form-control" value="{{$value->title}}" disabled>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="wd-300">
                                                                <input type="text" class="form-control" placeholder="مقدار"  wire:model="property_text.{{$value->id}}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="wd-100">
                                                                <label class="form-label">{{$value->value}}</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div wire:ignore.self class="tab-pane " id="NaghdOption" role="tabpanel">
                                    <div class="form-group">
                                        <div class="row row-sm">

                                            <label class="form-label col-sm-2">نقد و بررسی: </label>

                                            <div class="col-sm-10" wire:ignore>
                                                <textarea rows="10" id="summernote-editor1"
                                                          class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                          name="message" wire:model="product.naghd"
                                                          autocomplete="off">{{$product->naghd}}</textarea>
                                                @if ($errors->has('message'))
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div wire:ignore.self class="tab-pane " id="tab-attribute" role="tabpanel">
                                    <div class="table-responsive scrollbar"  id="style-1" >
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <td>ویژگی</td>
                                                <td></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($inputAttribues as $key => $value)
                                                <tr>
                                                    <td>
                                                    <textarea class="form-control" placeholder="ویژگی"
                                                              wire:model="attribue_name.{{ $key }}"></textarea>
                                                    </td>
                                                    <td>
                                                        <button class="bbtn ripple btn-secondary text-white btn-icon btn-sm"
                                                                wire:click.prevent="removeAttribues({{$key}})">
                                                            <i class="fa fa-minus-circle"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <br>
                                    <div class=" add-input ">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button class="btn ripple btn-primary text-white btn-icon btn-xs"
                                                        wire:click.prevent="AddAttribute({{$i}})">
                                                    <i class="fa fa-plus-circle"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane " id="tab-download" role="tabpanel">
                                    <div class="table-responsive scrollbar" id="style-1">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <td>عنوان</td>
                                            <td>فایل</td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($inputdownload as $key => $value)
                                            <tr>
                                                <td>
                                                    <div class="wd-200">
                                                    <input type="text" class="form-control" placeholder="عنوان"
                                                           wire:model="download_title.{{ $key }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="wd-300">
                                                    <input type="file" class="form-control"
                                                           wire:model="download_file_upload.{{ $key }}"
                                                           placeholder="فایل">
                                                    </div>
                                                    <span class="mt-2 text-danger" wire:loading
                                                          wire:target="download_file_upload.{{ $key }}">در حال آپلود ...</span>
                                                </td>
                                                <td>
                                                    <button class="bbtn ripple btn-secondary text-white btn-icon btn-sm"
                                                            wire:click.prevent="removeDownload({{$key}})">
                                                        <i class="fa fa-minus-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                    <br>
                                    <div class=" add-input">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button class="btn ripple btn-primary text-white btn-icon btn-xs"
                                                        wire:click.prevent="AddDownload({{$l}})"><i
                                                        class="fa fa-plus-circle"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane " id="tab-image" role="tabpanel">
                                    <div class="form-group">
                                        <div class="row row-sm">

                                            <label class="form-label col-sm-2">تصویر اصلی: <span
                                                    class="tx-danger">*</span></label>
                                            <div class="col-sm-10">
                                                @if($imageupadate)
                                                    <img style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;margin-top: 10px;cursor: pointer;"
                                                         class="form-control"
                                                         id="picture" src="{{$imageupadate->temporaryUrl()}}">
                                                @else
                                                    <img style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;margin-top: 10px;cursor: pointer;"
                                                         class="form-control"
                                                         id="picture"
                                                         src="/storage/{{$product->image}}">
                                                @endif
                                                <input id="fileinput" type="file" class="form-control"
                                                       wire:model.defer="imageupadate" style="display:none" accept="image/*">

                                                <span class="mt-2 text-danger" wire:loading
                                                      wire:target="imageupadate">در حال آپلود ...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane " id="tab-option" role="tabpanel">
                                    <div class="row row-sm">
                                        <div class="col-sm-12">
                                            <div class="tab-content">
                                                @if($showOptionUl !==[])
                                                    @foreach($showOptionUl as $key=>$value)
                                                        @php  $arrays=explode(',',$value); $meghdar=$arrays[0]; $type=$arrays[1]; @endphp
                                                        <div class="main-content-body p-4 border-top-0">
                                                            <div class="border" style="min-height: 150px;border: 1px solid #ddd;padding: 20px">
                                                                <div class="form-group">
                                                                    <div class="row row-sm">
                                                                        <div class="col-sm-6">
                                                                            <a class="btn ripple btn-primary"  style="margin-top: 15px;color: #fff">
                                                                                <i class="fa fa-minus-circle"
                                                                                   wire:click.prevent="removeOption({{$key}})"></i>
                                                                                {{$meghdar}}
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <lable for="nessecey{{$key}}">ضروری:</lable>
                                                                            <br>
                                                                            <select id="nessecey{{$key}}"
                                                                                    class="form-control"
                                                                                    wire:model.defer="option_required.{{$key}}">
                                                                                <option value="0" selected="selected">
                                                                                    خیر
                                                                                </option>
                                                                                <option value="1">بله</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row row-sm mt-3">
                                                                        <div class="col-sm-12">
                                                                            <div class="addoption">
                                                                                <div class="table-responsive scrollbar"  id="style-1">
                                                                                    @if($type !='input')
                                                                                    <table class="table table-striped table-bordered table-hover"
                                                                                           id="table{{$key}}">
                                                                                        <thead>
                                                                                        <tr id="tale_head_{{$key}}">
                                                                                            <td>مقدار گزینه</td>
                                                                                            @if($type=='color')
                                                                                                <td>انتخاب رنگ</td>
                                                                                            @endif
                                                                                            <td class="wd-lg-15p">تعداد</td>
                                                                                            <td class="wd-lg-15p">از انبار کم شود</td>
                                                                                            <td class="wd-lg-15p">قیمت</td>
                                                                                            <td class="wd-lg-15p">وزن</td>
                                                                                            <td class="wd-lg-5p"></td>
                                                                                        </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                        @isset($optionType1[$key])
                                                                                            @foreach($optionType1[$key] as $key1)
                                                                                                <tr id="option-value-row{{$key . $key1}}">
                                                                                                    <td class="text-left">
                                                                                                        <div class="wd-150">
                                                                                                            <input wire:model.defer="option_value.{{ $key}}.{{ $key1 }}"class="form-control">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    @if($type=='color')
                                                                                                        <td> <div class="wd-150">
                                                                                                                <input wire:model.defer="option_color.{{ $key}}.{{ $key1 }}" class="form-control" type="color">
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    @endif
                                                                                                    <td class="text-right">
                                                                                                        <div class="wd-150">
                                                                                                            <input wire:model.defer="option_quantity.{{ $key}}.{{ $key1 }}"placeholder="تعداد" class="form-control">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td class="text-left">
                                                                                                        <div class="wd-150">
                                                                                                            <select  class="form-control" wire:model.defer="option_anbar.{{ $key}}.{{ $key1 }}">
                                                                                                                <option value="1" selected="selected"> بله </option>
                                                                                                                <option value="0"> خیر</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td class="text-right">
                                                                                                        <div class="wd-150">
                                                                                                            <select class="form-control" wire:model.defer="price_prefix.{{ $key}}.{{ $key1 }}">
                                                                                                                <option  value="1"  selected="selected">
                                                                                                                    +
                                                                                                                </option>
                                                                                                                <option  value="0">  - </option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div class="wd-150">
                                                                                                            <input  type="text" wire:model.defer="option_price.{{ $key}}.{{ $key1 }}" placeholder="قیمت" class="form-control">
                                                                                                        </div>
                                                                                                    </td>

                                                                                                    <td class="text-right">
                                                                                                        <div class="wd-150">
                                                                                                            <select class="form-control"  wire:model.defer="weight_prefix.{{$key}}.{{ $key1 }}">
                                                                                                                <option  value="1" selected="selected">  +  </option>
                                                                                                                <option value="0">  - </option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                        <div class="wd-150">
                                                                                                            <input type="text" wire:model.defer="option_weight.{{$key}}.{{ $key1}}" placeholder="وزن"
                                                                                                                   class="form-control">
                                                                                                        </div>
                                                                                                    </td>
                                                                                                    <td class="text-left">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            wire:click.prevent.prefetch="removeoptionType1({{$key}},{{$key1}})"
                                                                                                            class="btn btn-danger"
                                                                                                            data-original-title="حذف">
                                                                                                            <i class="fa fa-minus-circle"></i>
                                                                                                        </button>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            @endforeach
                                                                                        @endisset
                                                                                        </tbody>
                                                                                    </table>
                                                                                    @endif
                                                                                    <div class=" add-input"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-md-12 text-center">

                                                                        <div
                                                                            wire:click.prevent="AddOptionType1({{$t1}},{{$key}})"
                                                                            class="btn ripple btn-primary text-white btn-icon btn-xs">
                                                                            <i class="fa fa-plus-circle"></i></div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        @if($type !='input')
                                        <div class="col-sm-12">
                                            <div class="row row-sm" wire:ignore>
                                                <div class="col-sm-4">
                                                    <label class="form-label">عنوان: </label>
                                                    <input class="form-control" wire:model="options">

                                                </div>
                                                <div class="col-sm-4">
                                                    <label class="form-label">نوع: </label>
                                                    <select id="option_type" wire:model="option_type"
                                                            class="form-control">
                                                        <option value="">انتخاب</option>
                                                        <option value="radio">رادیویی</option>
                                                        <option value="select">کشویی</option>
                                                        <option value="color">رنگ</option>
                                                        <option value="input">input</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 mt-4">
                                                    <button class="btn ripple  btn-primary" type="button"
                                                            wire:click.prevent="addOptionUl()">افزودن
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
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


@push('customcss')
    <!-- Internal Quill css-->
    <link href="{{asset('admin/plugins/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/quill/quill.bubble.css')}}" rel="stylesheet">
    <!-- Internal Summernote css-->
    <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
@endpush

@push('jsBeforCustomJs')

    <!-- Internal Quill js-->
    <script src="{{asset('admin/plugins/quill/quill.min.js')}}"></script>

    <!-- Internal Summernote js-->
    <script src="{{asset('admin/plugins/summernote/summernote-bs4.js')}}"></script>

    <!-- Internal Form-editor js-->
    <script src="{{asset('admin/js/form-editor.js')}}"></script>

    <script>
        // Define function to open filemanager window
        var lfm = function (options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
            window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
            window.SetUrl = cb;
        };

        // Define LFM summernote button
        var LFMButton = function (context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: 'Insert image with filemanager',
                click: function () {

                    lfm({type: 'image', prefix: '/laravel-filemanager'}, function (lfmItems, path) {
                        lfmItems.forEach(function (lfmItem) {
                            context.invoke('insertImage', lfmItem.url);
                        });
                    });

                }
            });
            return button.render();
        };
        $('#summernote-editor').summernote({

            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview', 'help']],
                ['popovers', ['lfm']],
            ],
            buttons: {
                lfm: LFMButton
            },
            height: 200,

            callbacks: {
                onChange: function (contents, $editable) {
                @this.set('product.description', contents);
                }
            },
        });
        $('#summernote-editor1').summernote({

            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview', 'help']],
                ['popovers', ['lfm']],
            ],
            buttons: {
                lfm: LFMButton
            },
            height: 200,

            callbacks: {
                onChange: function (contents, $editable) {
                @this.set('product.naghd', contents);
                }
            },
        });

    </script>
    <script>
        $(function () {
            $('#showproducts').select2({
                theme: 'bootstrap4',
            }).on('change', function () {
            @this.set('showproducts', $('#showproducts').val());
            })
        })
    </script>
@endpush

</div>

