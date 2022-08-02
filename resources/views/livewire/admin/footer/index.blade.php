@section('title','تنظیمات')
<div class="container-fluid">
    <div class="inner-body" >
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">تنظیمات</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> تنظیمات</li>
                </ol>
            </div>

        </div>
    @include('livewire.admin.layouts.message')
    <!-- Row -->
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        تنظیمات سایت
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="saveInfo">
                            <h2 class="main-content-title tx-24 mg-b-5"> بالای فوتر</h2>
                            <hr>
                            <table class="table table-bordered mg-b-0">
                                <thead>
                                    <tr>
                                        <td>ترتیب</td>
                                        <td>ایکن</td>
                                        <td>تصویر</td>
                                        <td>عنوان</td>
                                        <td>لینک</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="bd-t-0 bd-l-0">اول</td>
                                    <td >
                                        @if($icon_1)
                                                <img src="{{ $icon_1->temporaryUrl() }}" style="width: 80px;cursor: pointer;" id="picture">
                                         @elseif($icon_11)
                                                <img id="picture" style="width: 80px;cursor: pointer;"   src="/storage/{{$icon_11}}">
                                         @else
                                                <img id="picture" style="width:80px;cursor: pointer;"   src="{{ asset('assets/uploadicon.png')}}">
                                         @endif
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <div>
                                            <div class="form-group ">
                                                <input type="file"  wire:model.defer="icon_1" class="form-control">
                                                <span wire:loading wire:target="icon_1" class="text-danger">در حال آپلود</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.title_1" placeholder="عنوان" class="form-control">
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.link_1" placeholder="لینک"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd-t-0 bd-l-0">دوم</td>
                                    <td >
                                        @if($icon_2)
                                            <img src="{{ $icon_2->temporaryUrl() }}" style="width: 80px" id="picture">
                                        @elseif($icon_22)
                                            <img id="picture" style="width:80px;cursor: pointer;"  src="/storage/{{$icon_22}}">
                                        @else
                                            <img id="picture" style="width:80px;cursor: pointer;"   src="{{ asset('assets/uploadicon.png')}}">
                                        @endif
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <div>
                                            <div class="form-group ">
                                                <input type="file"  wire:model.defer="icon_2" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.title_2" placeholder="عنوان" class="form-control">
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.link_2" placeholder="لینک"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd-t-0 bd-l-0">سوم</td>
                                    <td >
                                        @if($icon_3)
                                            <img src="{{ $icon_3->temporaryUrl() }}" style="width: 80px" id="picture">
                                        @elseif($icon_33)
                                            <img id="picture" style="width:80px;cursor: pointer;"   src="/storage/{{$icon_33}}">
                                        @else
                                            <img id="picture" style="width:80px;cursor: pointer;"   src="{{ asset('assets/uploadicon.png')}}">
                                        @endif
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <div>
                                            <div class="form-group ">
                                                <input type="file"  wire:model.defer="icon_3" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.title_3" placeholder="عنوان" class="form-control">
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.link_3" placeholder="لینک"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd-t-0 bd-l-0">چهارم</td>
                                    <td >
                                        @if($icon_4)
                                            <img src="{{ $icon_4->temporaryUrl() }}" style="width: 80px" id="picture">
                                        @elseif($icon_44)
                                            <img id="picture" style="width:80px;cursor: pointer;"   src="/storage/{{$icon_44}}">
                                        @else
                                            <img id="picture" style="width:80px;cursor: pointer;"   src="{{ asset('assets/uploadicon.png')}}">
                                        @endif
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <div>
                                            <div class="form-group ">
                                                <input type="file"  wire:model.defer="icon_4" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.title_4" placeholder="عنوان" class="form-control">
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.link_4" placeholder="لینک"  class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd-t-0 bd-l-0">پنجم</td>
                                    <td >
                                        @if($icon_5)
                                            <img src="{{ $icon_5->temporaryUrl() }}" style="width: 80px" id="picture">
                                        @elseif($icon_55)
                                            <img id="picture" style="width:80px;cursor: pointer;"   src="/storage/{{$icon_55}}">
                                        @else
                                            <img id="picture" style="width:80px;cursor: pointer;"   src="{{ asset('assets/uploadicon.png')}}">
                                        @endif
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <div>
                                            <div class="form-group ">
                                                <input type="file"  wire:model.defer="icon_5" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.title_5" placeholder="عنوان" class="form-control">
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.link_5" placeholder="لینک"  class="form-control">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <h2 class="main-content-title tx-24 mg-b-5">وسط فوتر</h2>
                            <hr>
                            <table class="table table-bordered mg-b-0">
                                <thead>
                                <tr>
                                    <td>ترتیب</td>
                                    <td>عنوان سردسته</td>
                                    <td> عنوان دسته</td>
                                    <td>لینک دسته</td>
                                </tr>

                                </thead>
                                <tbody>
                                <tr>
                                    <td class="bd-t-0 bd-l-0">اول</td>
                                    <td class="bd-t-0 bd-l-0">
                                        <div>
                                            <div class="form-group ">
                                                <input type="text" placeholder="عنوان" wire:model.defer="footer.category_1" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.title_sub_1" placeholder=" عنوان اول" class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_2" placeholder="عنوان دوم " class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_3" placeholder="عنوان سوم" class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_4" placeholder="عنوان چهارم" class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_5" placeholder="عنوان پنجم" class="form-control">
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.link_sub_1" placeholder="لینک اول "  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_2" placeholder="لینک دوم"  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_3" placeholder="لینک سوم"  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_4" placeholder="لینک چهارم"  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_5" placeholder="لینک پنجم"  class="form-control"><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd-t-0 bd-l-0">دوم</td>
                                    <td class="bd-t-0 bd-l-0">
                                        <div>
                                            <div class="form-group ">
                                                <input type="text" placeholder="عنوان" wire:model.defer="footer.category_2" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.title_sub_21" placeholder=" عنوان اول" class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_22" placeholder="عنوان دوم " class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_23" placeholder="عنوان سوم" class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_24" placeholder="عنوان چهارم" class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_25" placeholder="عنوان پنجم" class="form-control">
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.link_sub_21" placeholder="لینک اول "  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_22" placeholder="لینک دوم"  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_23" placeholder="لینک سوم"  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_24" placeholder="لینک چهارم"  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_25" placeholder="لینک پنجم"  class="form-control"><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bd-t-0 bd-l-0">سوم</td>
                                    <td class="bd-t-0 bd-l-0">
                                        <div>
                                            <div class="form-group ">
                                                <input type="text" placeholder="عنوان" wire:model.defer="footer.category_3" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.title_sub_31" placeholder=" عنوان اول" class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_32" placeholder="عنوان دوم " class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_33" placeholder="عنوان سوم" class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_34" placeholder="عنوان چهارم" class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.title_sub_35" placeholder="عنوان پنجم" class="form-control">
                                    </td>
                                    <td class="bd-t-0 bd-l-0">
                                        <input type="text"  wire:model.defer="footer.link_sub_31" placeholder="لینک اول "  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_32" placeholder="لینک دوم"  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_33" placeholder="لینک سوم"  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_34" placeholder="لینک چهارم"  class="form-control"><br>
                                        <input type="text"  wire:model.defer="footer.link_sub_35" placeholder="لینک پنجم"  class="form-control"><br>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <br>
                            <h2 class="main-content-title tx-24 mg-b-5">پایین فوتر</h2>
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <textarea rows="8"  class="form-control" wire:model.defer="footer.footer_bottom" placeholder="توضیحات پایین فوتر"></textarea>
                                    @error('footer.footer_bottom')
                                    <div class="invalid-feedback display-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row -->
    </div>
</div>

