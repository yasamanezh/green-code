@section('title','ماژول ها')
<div class="container-fluid" id="page_builder">
   <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ماژول ها</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ماژول ها</li>
                </ol>

            </div>
            <div class="float-left">
                <button class="btn btn-primary" wire:click.prevent="saveTotalData" wire:loading.remove >ذخیره</button>
                <div wire:loading wire:target="saveTotalData">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>

        </div>
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custome-card">

                </div>
                @if($showrow !==[])
                    @foreach($showrow as $key=>$value)

                    <div class="card custom-card">
                        <div class="card-header  border-bottom-0 pb-0 bg-primary">
                            <div class="d-flex justify-content-between">
                                <a aria-controls="collapseExample" aria-expanded="true" class="btn ripple btn-primary collapsed" data-toggle="collapse" href="#collapseGeneral{{$key}}" role="button" style="margin-top: -4px;margin-right: -10px;margin-bottom: 10px;margin-left: 10px;"> <i  style="color: #fff"  class="fa fa-edit"></i> </a>

                                <label  class="main-content-label mb-0 pt-1"> <a href="" class="remove" wire:click.prevent="removeRow({{$key}})" style="curser:pointer"><i style="color: #fff" class="fa fa-minus-circle"></i></a>
                                </label>

                                    <div class="mr-auto float-right">
                                    <a class="btn ripple btn-primary" data-target="#modal-datepicker{{$key}}" data-toggle="modal" href="#"><i class="fe fe-more-horizontal"></i></a>
                                   <!--start modal --->
                                    <div class="modal" id="modal-datepicker{{$key}}" style="display: none; padding-right: 17px;" aria-modal="true">
                                        <div class="modal-dialog" style="max-width: 700px !important;"  role="document" >
                                            <div class="modal-content modal-content-demo " style="border-radius:5px">
                                                <div class="modal-header border-bottom-0" style="background: #6259ca ">
                                                    <h6 wire:ignore class="modal-title" style="color: #fff">تنظیمات ردیف</h6><button style="color: #fff" aria-label="بستن" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body" style="padding: 0 !important;">
                                                    <div style="padding: 25px">
                                                        <div class="form-group">
                                                            <label class="form-label">margin (فاصله خارجی بر حسب px):</label>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <input class="form-control" wire:model.defer="row_magin_top.{{$key}}">
                                                                    <label class="form-label">بالا:</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input class="form-control" wire:model.defer="row_magin_right.{{$key}}">
                                                                    <label class="form-label">راست:</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input class="form-control" wire:model.defer="row_magin_bottom.{{$key}}">
                                                                    <label class="form-label">پایین:</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input class="form-control" wire:model.defer="row_magin_left.{{$key}}">
                                                                    <label class="form-label">چپ:</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">padding (فاصله داخلی بر حسب px):</label>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <input class="form-control" wire:model.defer="row_padding_top.{{$key}}">
                                                                    <label class="form-label">بالا:</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input class="form-control" wire:model.defer="row_padding_right.{{$key}}">
                                                                    <label class="form-label">راست:</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input class="form-control" wire:model.defer="row_padding_bottom.{{$key}}">
                                                                    <label class="form-label">پایین:</label>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <input class="form-control" wire:model.defer="row_padding_left.{{$key}}">
                                                                    <label class="form-label">چپ:</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <label class="form-label">نحوه نمایش:</label>
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <select  value="" wire:model.defer="row_full_page.{{$key}}" class="form-control">
                                                                        <option value="container-fluid">container-fluid </option>
                                                                        <option value="container">container</option>
                                                                        <option value="width-100">تمام صفحه</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <label class="form-label">ارتفاع:</label>
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <input  value="" wire:model.defer="row_height.{{$key}}" class="form-control">

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <label class="form-label">رنگ پس زمینه:</label>
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <input type="color"  value="" wire:model.defer="row_bg_color.{{$key}}" class="form-control">

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <label class="form-label">نمایش  رنگ پس زمینه:</label>
                                                                </div>
                                                                <div class="col-sm-10">
                                                                    <select  value="" wire:model.defer="row_bg_color_status.{{$key}}" class="form-control">
                                                                        <option value="">انتخاب</option>
                                                                        <option value="1">بله</option>
                                                                        <option value="0">خیر</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn ripple btn-primary" wire:ignore  data-dismiss="modal" >ذخیره تغییرات</button>
                                                    <button class="btn ripple btn-secondary"  wire:ignore data-dismiss="modal" type="button">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!----end modal-->
                                </div>
                            </div>

                        </div>

                        <div class="card-body birder collapse" wire:ignore.self id="collapseGeneral{{$key}}">
                            <div class="main-content-body p-4 border-top-0 ">
                                <div class="border" style="min-height: 150px;border: 1px solid #ddd;padding: 20px">
                                    <div class="row row-sm">
                                             @isset($optionType1[$key])
                                                @foreach($optionType1[$key] as $key1)
                                                    <div class="col-sm-{{$col[$key][$key1]}}">
                                                        <div  style="background: #ddd;margin-bottom: 10px">
                                                            <div class="card-header p-3 tx-medium my-auto tx-white bg-success">
                                                                <div class="d-flex justify-content-between">
                                                                    <label class="main-content-label mb-0 pt-1" > <a href="" class="remove" wire:click.prevent.prefetch="removeColume({{$key}},{{$key1}})"  style="curser:pointer"><i style="color: #fff" class="fa fa-minus-circle"></i></a>
                                                                    </label>
                                                                    <div class="mr-auto float-right">
                                                                        <a  class="btn ripple" style="color: #fff" data-target="#modal-datepicker{{$key.$key1}}" data-toggle="modal" href="#"><i class="fe fe-more-horizontal"></i></a>
                                                                        <!--start modal --->
                                                                        <div class="modal" id="modal-datepicker{{$key.$key1}}" style="display: none; padding-right: 17px;" aria-modal="true">
                                                                            <div class="modal-dialog" style="max-width: 700px !important;"  role="document" >
                                                                                <div class="modal-content modal-content-demo " style="border-radius:5px">
                                                                                    <div class="modal-header border-bottom-0" style="background: #6259ca ">
                                                                                        <h6 class="modal-title" style="color: #fff">تنظیمات ابعاد ستون</h6><button style="color: #fff" aria-label="بستن" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                                                    </div>
                                                                                    <div class="modal-body" style="padding: 0 !important;">
                                                                                        <div style="padding: 25px">
                                                                                            <div class="form-group">

                                                                                                <div class="row">
                                                                                                    <div class="col-md-3">
                                                                                                        <div class="form-group">
                                                                                                            <label class="form-label">موبایل (col-xs)</label>
                                                                                                            <select class="form-control" wire:model.defer="col_xs.{{$key}}.{{$key1}}">
                                                                                                                <option value="">انتخاب</option>
                                                                                                                <option value="1">1/12</option>
                                                                                                                <option value="2">2/12</option>
                                                                                                                <option value="3">3/12</option>
                                                                                                                <option value="4">4/12</option>
                                                                                                                <option value="5">5/12</option>
                                                                                                                <option value="6">6/12</option>
                                                                                                                <option value="7">7/12</option>
                                                                                                                <option value="8">8/12</option>
                                                                                                                <option value="9">9/12</option>
                                                                                                                <option value="10">10/12</option>
                                                                                                                <option value="11">11/12</option>
                                                                                                                <option value="12">12/12</option>
                                                                                                                <option value="hidden-xs">عدم نمایش</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-sm-3">
                                                                                                        <label class="form-label">فبلت (col-sm)</label>
                                                                                                        <select class="form-control" wire:model.defer="col.{{$key}}.{{$key1}}">
                                                                                                            <option value="">انتخاب</option>
                                                                                                            <option value="1">1/12</option>
                                                                                                            <option value="2">2/12</option>
                                                                                                            <option value="3">3/12</option>
                                                                                                            <option value="4">4/12</option>
                                                                                                            <option value="5">5/12</option>
                                                                                                            <option value="6">6/12</option>
                                                                                                            <option value="7">7/12</option>
                                                                                                            <option value="8">8/12</option>
                                                                                                            <option value="9">9/12</option>
                                                                                                            <option value="10">10/12</option>
                                                                                                            <option value="11">11/12</option>
                                                                                                            <option value="12">12/12</option>
                                                                                                            <option value="hidden-sm">عدم نمایش</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-md-3 ">
                                                                                                        <div class="form-group">
                                                                                                            <label class="form-label">تبلت (col-md)</label>
                                                                                                            <select class="form-control" wire:model.defer="col_md.{{$key}}.{{$key1}}">
                                                                                                                <option value="">انتخاب</option>
                                                                                                                <option value="1">1/12</option>
                                                                                                                <option value="2">2/12</option>
                                                                                                                <option value="3">3/12</option>
                                                                                                                <option value="4">4/12</option>
                                                                                                                <option value="5">5/12</option>
                                                                                                                <option value="6">6/12</option>
                                                                                                                <option value="7">7/12</option>
                                                                                                                <option value="8">8/12</option>
                                                                                                                <option value="9">9/12</option>
                                                                                                                <option value="10">10/12</option>
                                                                                                                <option value="11">11/12</option>
                                                                                                                <option value="12">12/12</option>
                                                                                                                <option value="hidden-md">عدم نمایش</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3">
                                                                                                        <div class="form-group">
                                                                                                            <label class="form-label">کامپیوتر (col-lg)</label>
                                                                                                            <select class="form-control" wire:model.defer="col_lg.{{$key}}.{{$key1}}">
                                                                                                                <option value="">انتخاب</option>
                                                                                                                <option value="1">1/12</option>
                                                                                                                <option value="2">2/12</option>
                                                                                                                <option value="3">3/12</option>
                                                                                                                <option value="4">4/12</option>
                                                                                                                <option value="5">5/12</option>
                                                                                                                <option value="6">6/12</option>
                                                                                                                <option value="7">7/12</option>
                                                                                                                <option value="8">8/12</option>
                                                                                                                <option value="9">9/12</option>
                                                                                                                <option value="10">10/12</option>
                                                                                                                <option value="11">11/12</option>
                                                                                                                <option value="12">12/12</option>
                                                                                                                <option value="hidden-lg">عدم نمایش</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button class="btn ripple btn-primary"  data-dismiss="modal"  >ذخیره تغییرات</button>
                                                                                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">بستن</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!----end modal-->
                                                                    </div>

                                                                </div>


                                                            </div>
                                                            <div class="card-body">
                                                                @isset($modules[$key][$key1])
                                                                    @foreach($modules[$key][$key1] as $key2=>$value2)

                                                                        <div class="card custom-card">
                                                                            <div class="card-header p-3 tx-medium my-auto tx-white bg-secondary">
                                                                                <label class="main-content-label mb-0 pt-1" > <a href="" class="remove" wire:click.prevent="removemodule({{$key}},{{$key1}}, {{$key2}})"  style="curser:pointer"><i style="color: #fff" class="fa fa-minus-circle"></i></a>
                                                                                </label>
                                                                                <a class="option-dots  float-left" style="color: #fff;font-size: 25px" data-target="#modal-datepicker{{$key.$key1 . $key2}}" data-toggle="modal" href="#"><i class="fe fe-more-horizontal"></i></a>

                                                                                <!--start modal --->
                                                                                <div class="modal" id="modal-datepicker{{$key.$key1 . $key2}}" style="display: none; padding-right: 17px;" aria-modal="true">
                                                                                    <div class="modal-dialog" style="max-width: 700px !important;"  role="document" >
                                                                                        <div class="modal-content modal-content-demo " style="border-radius:5px">
                                                                                            <div class="modal-header border-bottom-0" style="background: #6259ca ">
                                                                                                <h6 class="modal-title" style="color: #fff">تنظیمات ردیف</h6><button style="color: #fff" aria-label="بستن" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                                                                                            </div>
                                                                                            <div class="modal-body" style="padding: 0 !important;">
                                                                                                <div style="padding: 25px">
                                                                                                    <div class="form-group">
                                                                                                        <label class="form-label">margin (فاصله خارجی بر حسب px):</label>
                                                                                                        <div class="row">
                                                                                                            <div class="col-sm-3">
                                                                                                                <input class="form-control" wire:model.defer="module_magin_top.{{$key}}.{{$key1}}.{{$value2}}">
                                                                                                                <label class="form-label">بالا:</label>
                                                                                                            </div>
                                                                                                            <div class="col-sm-3">
                                                                                                                <input class="form-control" wire:model.defer="module_magin_right.{{$key}}.{{$key1}}.{{$value2}}">
                                                                                                                <label class="form-label">راست:</label>
                                                                                                            </div>
                                                                                                            <div class="col-sm-3">
                                                                                                                <input class="form-control" wire:model.defer="module_magin_bottom.{{$key}}.{{$key1}}.{{$value2}}">
                                                                                                                <label class="form-label">پایین:</label>
                                                                                                            </div>
                                                                                                            <div class="col-sm-3">
                                                                                                                <input class="form-control" wire:model.defer="module_magin_left.{{$key}}.{{$key1}}.{{$value2}}">
                                                                                                                <label class="form-label">چپ:</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group">
                                                                                                        <label class="form-label">padding (فاصله داخلی بر حسب px):</label>
                                                                                                        <div class="row">
                                                                                                            <div class="col-sm-3">
                                                                                                                <input class="form-control" wire:model.defer="module_padding_top.{{$key}}.{{$key1}}.{{$key2}}">
                                                                                                                <label class="form-label">بالا:</label>
                                                                                                            </div>
                                                                                                            <div class="col-sm-3">
                                                                                                                <input class="form-control" wire:model.defer="module_padding_right.{{$key}}.{{$key1}}.{{$key2}}">
                                                                                                                <label class="form-label">راست:</label>
                                                                                                            </div>
                                                                                                            <div class="col-sm-3">
                                                                                                                <input class="form-control" wire:model.defer="module_padding_bottom.{{$key}}.{{$key1}}.{{$key2}}">
                                                                                                                <label class="form-label">پایین:</label>
                                                                                                            </div>
                                                                                                            <div class="col-sm-3">
                                                                                                                <input class="form-control" wire:model.defer="module_padding_left.{{$key}}.{{$key1}}.{{$key2}}">
                                                                                                                <label class="form-label">چپ:</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button class="btn ripple btn-primary" data-dismiss="modal" >ذخیره تغییرات</button>
                                                                                                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">بستن</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="card-body">
                                                                                @isset($module_name[$key][$key1][$key2])
                                                                                    @php  $array=explode(',',$module_name[$key][$key1][$key2] );  @endphp
                                                                                    @if($array[0]=='banner')
                                                                                        @php   $bannerTitle=\App\Models\Banner::where('id',$array[1])->first() @endphp
                                                                                        @if($bannerTitle)
                                                                                            <span>بنر- {{ $bannerTitle->title }}</span>
                                                                                        @endif

                                                                                    @elseif($array[0]=='html')
                                                                                        @php   $htmlTitle=\App\Models\Html::where('id',$array[1])->first() @endphp
                                                                                        @if($htmlTitle)
                                                                                            <span>html- {{ $htmlTitle->title }}</span>
                                                                                        @endif
                                                                                    @elseif($array[0]=='logo')
                                                                                        <span>logo</span>
                                                                                    @elseif($array[0]=='contact')
                                                                                        <span>فرم تماس با ما</span>
                                                                                    @elseif($array[0]=='blog')
                                                                                        <span>اخرین مطالب وبلاگ</span>

                                                                                    @endif

                                                                                @endisset
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                    <div class="row">
                                                                        <div class="col-md-12 text-center">
                                                                            <div class="form-group">
                                                                                <label class="form-label" >انتخاب ماژول</label>
                                                                                <select class="form-control" style="color: #000000" wire:model="moduleName">
                                                                                    <option value="">هیچکدام</option>

                                                                                    @foreach($banners as $banner)
                                                                                        <option value="banner,{{$banner->id}}">بنر - {{$banner->title}}</option>
                                                                                    @endforeach
                                                                                    @foreach($htmls as $html)

                                                                                        <option value="html,{{$html->id}}">html - {{$html->title}}</option>

                                                                                    @endforeach
                                                                                    <option  value="logo">لوگو</option>
                                                                                    <option value="contact">فرم تماس با ما</option>
                                                                                    <option  value="blog">اخرین مطالب وبلاگ</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 text-center">
                                                                            <div style="margin-top: 22px" wire:click.prevent="AddModule({{$t3}},{{$key}},{{$key1}})"
                                                                                 class="btn ripple btn-primary text-white btn-icon btn-xs">
                                                                                <i class="fa fa-plus-circle"></i></div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endisset
                                        </div>
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <div class="form-group">
                                                <label class="form-label">انتخاب ابعاد ستون:</label>
                                                <select class="form-control" wire:model="col_sm">
                                                    <option selected value="">انتخاب</option>
                                                    <option value="1">1/12</option>
                                                    <option value="2">2/12</option>
                                                    <option value="3">3/12</option>
                                                    <option value="4">4/12</option>
                                                    <option value="5">5/12</option>
                                                    <option value="6">6/12</option>
                                                    <option value="7">7/12</option>
                                                    <option value="8">8/12</option>
                                                    <option value="9">9/12</option>
                                                    <option value="10">10/12</option>
                                                    <option value="11">11/12</option>
                                                    <option value="12">12/12</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <div style="margin-top: 22px" wire:click.prevent="AddColume({{$t2}},{{$key}})"
                                                class="btn ripple btn-primary text-white btn-icon btn-xs">
                                                <i class="fa fa-plus-circle"></i></div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>

                @endforeach
                @endif
                    <div class="col-sm-12">
                         <button class="btn ripple  btn-primary" type="button"  wire:click.prevent="addRow({{$t1}})">
                             <i class="fa fa-plus-circle"></i>
                        </button>

                    </div>
            </div>


        </div>
    </div>

</div>

