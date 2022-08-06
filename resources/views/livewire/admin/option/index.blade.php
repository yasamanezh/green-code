<div>
@section('title','تنظیمات')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">تنظیمات</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> تنظیمات</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary" type="submit">ذخیره</button>
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <ul class="item1-links nav nav-tabs  mb-0">
                        <li class="nav-item">
                            <a wire:ignore data-target="#options" class="nav-link active" data-toggle="tab"
                               role="tablist" style="cursor: pointer;"> عمومی</a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#shop" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">سئو </a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-image" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;"> تصاویر </a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-mail" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;"> ایمیل </a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-sms" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;"> پیامک </a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-google" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;"> کد و ادرس ها </a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-bank" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">درگاه های بانک </a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-ads" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">تبلیغات </a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-Notices" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">اطلاع رسانی </a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-advance" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">پیشرفته </a>
                        </li>
                        <li class="nav-item">
                            <a wire:ignore data-target="#tab-license" class="nav-link" data-toggle="tab" role="tablist"
                               style="cursor: pointer;">فعال سازی سیستم</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        تنظیمات سایت
                    </div>
                    <div class="card-body">
                        <form id="saveForm">
                            <div class="tab-content" id="myTabContent">
                                <div wire:ignore.self class="tab-pane fade show active" id="options" role="tabpanel">
                                    <div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label" for="input-name">نام فروشگاه</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" wire:model.defer="siteOption.name"
                                                       value="" placeholder="نام فروشگاه"
                                                       id="input-name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="province" class="form-label col-sm-2">استان <span
                                                        class="required-star" style="color:red;"></span></label>
                                            <div class="col-sm-10">

                                                     <input  wire:model="siteOption.zone"  class="form-control">


                                                @error('state')
                                                <div class="invalid-feedback" style="display: block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="city" class="form-label col-sm-2">شهر </label>
                                            <div class="col-sm-10">
                                                <input wire:model.defer="siteOption.city" name="" id="city"
                                                        class="form-control">

                                                @error('city')
                                                <div class="invalid-feedback" style="display: block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="form-label col-sm-2">آدرس: </label>
                                            <div class="col-sm-10">
                                          <textarea wire:model.defer="siteOption.address" placeholder="آدرس" rows="5"
                                                    id="input-address" class="form-control">آدرس فروشگاه در این محل درج شود.
                                         </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label" for="input-email">ایمیل</label>
                                            <div class="col-sm-10">
                                                <input type="text" wire:model.defer="siteOption.email"
                                                       placeholder="ایمیل" id="input-email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label" for="input-telephone">تلفن</label>
                                            <div class="col-sm-10">
                                                <input type="text" wire:model.defer="siteOption.telephone"
                                                       placeholder="تلفن" id="input-telephone" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label" for="input-fax">صفحه اصلی سایت</label>
                                            <div class="col-sm-10">
                                                <select wire:model.defer="siteOption.home" class="form-control">
                                                    <option value="0">پیش فرض</option>
                                                    @foreach($pages as $page)
                                                        <option value="{{$page->id}}">{{$page->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" id="shop" role="tabpanel">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label" for="input-meta-title">متای عنوان</label>
                                        <div class="col-sm-10">
                                            <input type="text" wire:model.defer="siteOption.meta_title"
                                                   value="متای تگ عنوان"
                                                   placeholder="متای عنوان" id="input-meta-title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label" for="input-meta-description">متا تگ
                                            توضیحات</label>
                                        <div class="col-sm-10">
                                            <textarea wire:model.defer="siteOption.meta_description" rows="5"
                                                      placeholder="متا تگ توضیحات" id="input-meta-description"
                                                      class="form-control">توضیحی مختصر در مورد فروشگاه در این بخش نوشته شود. این توضیحات در جستجوی گوگل خیلی موثر می باشد.</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label" for="input-meta-keyword">متا تگ کلمات
                                            کلیدی</label>
                                        <div class="col-sm-10">
                                            <textarea wire:model.defer="siteOption.meta_keyword" rows="5"
                                                      placeholder="متا تگ کلمات کلیدی" id="input-meta-keyword"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" role="tabpanel" id="tab-image">
                                    <div class="form-group  row">
                                        <label class="col-sm-2 form-label" for="input-icon">مهر و امضاء</label>
                                        <div class="col-sm-10">
                                            @if($Signature)
                                                <img src="{{ $Signature->temporaryUrl() }}"
                                                     style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                     id="picture3">
                                            @elseif($uploadSignature)
                                                <img id="picture3"
                                                     style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                     src="/storage/{{$uploadSignature}}"
                                            @else
                                                <img id="picture3"
                                                     style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                     src="{{ asset('assets/uploadicon.png')}}"

                                            @endif
                                            <br>
                                            <br>
                                            <input type="file" wire:model.defer="Signature" style="display:none"
                                                   id="fileinput3" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label" for="input-logo">لوگوی فروشگاه</label>
                                        <div class="col-sm-10">
                                            @if($logo)
                                                <img src="{{ $logo->temporaryUrl() }}"
                                                     style="width: 200px;height:80px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                     id="picture">
                                            @elseif($uploadlogo)
                                                <img id="picture"
                                                     style="width: 200px;height:80px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                     src="/storage/{{$uploadlogo}}"
                                            @else
                                                <img id="picture"
                                                     style="width: 200px;height:80px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                     src="{{ asset('assets/uploadicon.png')}}"
                                            @endif
                                            <br>
                                            <br>
                                            <input  type="file" wire:model.defer="logo"
                                                   style="display:none;" id="fileinput" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 form-label" for="input-icon">آیکون</label>
                                        <div class="col-sm-10">
                                            @if($icon)
                                                <img src="{{ $icon->temporaryUrl() }}"
                                                     style="width: 50px;height:50px;padding: 10px;border:2px dashed #ddd;"
                                                     id="picture1">
                                            @elseif($uploadicon)
                                                <img id="picture1"
                                                     style="width: 50px;height:50px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                     src="/storage/{{$uploadicon}}"

                                            @else
                                                <img id="picture1"
                                                     style="width: 50px;height:50px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                     src="{{ asset('assets/uploadicon.png')}}"

                                            @endif
                                            <br>
                                            <br>
                                            <input name="UpdatedPhoto" type="file" wire:model.defer="icon"  style="display:none" id="fileinput1" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" role="tabpanel" id="tab-mail">
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-label" for="input-mail-parameter">ایمیل
                                            (MAIL_FROM_ADDRESS)
                                            </label>
                                        <div class="col-sm-8">
                                            <input type="text" wire:model.defer="siteOption.mail_parameter" value=""
                                                   placeholder="ایمیل" id="input-mail-parameter" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-label" for="input-mail-smtp-username">نام
                                            کاربری (MAIL_USERNAME)</label>
                                        <div class="col-sm-8">
                                            <input type="text" wire:model.defer="siteOption.mail_username"
                                                   placeholder="نام کاربری " id="input-mail-smtp-username"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-label" for="input-mail-smtp-password">رمز
                                            عبور(MAIL_PASSWORD) </label>
                                        <div class="col-sm-8">
                                            <input type="text" wire:model.defer="siteOption.mail_password" value=""
                                                   placeholder="رمز عبور " id="input-mail-smtp-password"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-label" for="mail_mailer">پارامتر ایمیل
                                            (MAIL_MAILER) </label>
                                        <div class="col-sm-8">
                                            <input type="text" wire:model.defer="siteOption.mail_mailer" value=""
                                                   placeholder="مثلا smtp " id="mail_mailer"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-label" for="mail-host">هاست
                                            (MAIL_HOST) </label>
                                        <div class="col-sm-8">
                                            <input type="text" wire:model.defer="siteOption.mail_host" value=""
                                                   placeholder="smtp.mailtrap.io" id="mail_host"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-label" for="port">پورت
                                            (MAIL_PORT) </label>
                                        <div class="col-sm-8">
                                            <input type="text" wire:model.defer="siteOption.mail_port" value=""
                                                   placeholder="25" id="port"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 form-label" for="tls">رمز نگاری
                                            (MAIL_ENCRYPTION) </label>
                                        <div class="col-sm-8">
                                            <input type="text" wire:model.defer="siteOption.mail_encription" value=""
                                                   placeholder="tls" id="tls"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" role="tabpanel" id="tab-sms">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label" for="input-mail-parameter">شماره سامانه
                                            پیامک</label>
                                        <div class="col-sm-10">
                                            <input type="text" wire:model.defer="siteOption.sms_panel"
                                                   placeholder="شماره سامانه پیامک" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label">نام کاربری</label>
                                        <div class="col-sm-10">
                                            <input type="text" wire:model.defer="siteOption.sms_usename"
                                                   placeholder="نام کاربری" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label">رمز عبور</label>
                                        <div class="col-sm-10">
                                            <input type="text" wire:model.defer="siteOption.sms_password"
                                                   placeholder="رمز عبور" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" role="tabpanel" id="tab-google">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label" for="header_code">کدهای هدر </label>
                                        <div class="col-sm-10">
                                            <textarea dir="ltr" wire:model.defer="siteOption.header_code" rows="10"
                                                      id="header_code" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label" for="footer_code">کد های فوتر</label>
                                        <div class="col-sm-10">
                                            <textarea dir="ltr" type="text" rows="10" class="form-control"
                                                      wire:model.defer="siteOption.footer_code"
                                                      id="footer_code"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label">آدرس نماد ساماندهی</label>
                                        <div class="col-sm-10">
                                            <input type="text" wire:model.defer="siteOption.samandehi"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label" for="input-google-captcha-public">ادرس نماد
                                            اعتماد</label>
                                        <div class="col-sm-10">
                                            <input type="text" wire:model.defer="siteOption.enamad"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" role="tabpanel" id="tab-bank">
                                    <fieldset>
                                        <legend>صادرات</legend>
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label">شماره ترمینال</label>
                                            <div class="col-sm-10">
                                                <input wire:model.defer="siteOption.saderat_terminal"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label">نمایش درگاه</label>
                                            <div class="col-sm-10">
                                                <select class="form-control"
                                                        wire:model.defer="siteOption.saderat_status">
                                                    <option value="0" selected="selected">خیر</option>
                                                    <option value="1">بله</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>ملی</legend>
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label">شماره ترمینال</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" wire:model.defer="siteOption.meli_terminal">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label">مرچنت کد</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" wire:model.defer="siteOption.meli_merchent">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label">کلید</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" wire:model.defer="siteOption.meli_key">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label">نمایش درگاه</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" wire:model.defer="siteOption.meli_status">
                                                    <option value="0">خیر</option>
                                                    <option value="1">بله</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>زرین پال</legend>
                                        <hr>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label">مرچنت کد</label>
                                            <div class="col-sm-10">
                                                <input wire:model.defer="siteOption.zarrinpall_merchent"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 form-label">نمایش درگاه</label>
                                            <div class="col-sm-10">
                                                <select class="form-control"
                                                        wire:model.defer="siteOption.zarrinpall_status">
                                                    <option value="0">خیر</option>
                                                    <option value="1">بله</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label">پرداخت هنگام تحویل</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" wire:model.defer="siteOption.offline_pay">
                                                <option value="0">خیر</option>
                                                <option value="1">بله</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" role="tabpanel" id="tab-Notices">
                                    <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                        <h6 class="main-content-label mb-1">اطلاع رسانی کاربر</h6>
                                        <br>
                                        <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                            <legend>ثبت نام</legend>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.register_sms">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">اس ام اس </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.register_email">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">ایمیل</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                            <legend>تکمیل خرید</legend>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.order_sms">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">اس ام اس </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.order_email">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">ایمیل</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                            <legend>ارسال سفارش</legend>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.order_complate_sms">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">اس ام اس </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.order_complate_email">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">ایمیل</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                            <legend>پاسخ پرسش</legend>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.question_answer_sms">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">اس ام اس </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.question_answer_email">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">ایمیل</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                        <h6 class="main-content-label mb-1">اطلاع رسانی ادمین</h6>
                                        <br>
                                        <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                            <legend>ثبت نام</legend>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.register_sms_admin">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">اس ام اس </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.register_email_admin">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">ایمیل</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                            <legend>تکمیل خرید</legend>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.order_sms_admin">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">اس ام اس </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.order_email_admin">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">ایمیل</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                            <legend>دیدگاه مقالات</legend>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.comment_sms">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">اس ام اس </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.comment_email">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">ایمیل</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                            <legend> پرسش ها</legend>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.question_sms">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">اس ام اس </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.question_email">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">ایمیل</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                            <legend>دیدگاه محصولات</legend>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.comment_product_sms">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">اس ام اس </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.comment_product_email">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">ایمیل</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group pb-0 pl-5 pr-5 pt-3 border rounded-10">
                                            <legend>تماس با ما:</legend>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.contact_sms">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">اس ام اس </span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                           class="custom-switch-input"
                                                           wire:model.defer="siteOption.contact_email">
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description">ایمیل</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" role="tabpanel" id="tab-ads">
                                    <div class="form-group row">
                                        <label class="col-sm-2 form-label" for="input-logo">تصویر تبلیغ :</label>
                                        <div class="col-sm-10">
                                            @if($ads)
                                                    <img id="picture2" src="{{ $ads->temporaryUrl() }}"
                                                         style="width: 400px;height:80px;padding: 10px;border:2px dashed #ddd;">

                                            @elseif($uploadads)
                                                <img id="picture2"  style="width: 400px;height:80px;padding: 10px;border:2px dashed #ddd;"
                                                     src="/storage/{{$uploadads}}"
                                            @else
                                                <img id="picture2"
                                                     style="width: 400px;height:80px;padding: 10px;border:2px dashed #ddd;"
                                                     src="{{ asset('assets/uploadicon.png')}}"
                                            @endif
                                            <br>
                                            <br>
                                            <input type="file" wire:model.defer="ads" style="display:none" id="fileinput2"/>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 form-label" for="input-icon">لینک تبلیغ</label>
                                        <div class="col-sm-10">
                                            <input wire:model.defer="siteOption.ads_link" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 form-label" for="input-icon">نمایش تبلیغ: </label>
                                        <div class="col-sm-10">
                                            <select wire:model.defer="siteOption.ads_status" class="form-control">
                                                <option value="">انتخاب</option>
                                                <option value="1">بله</option>
                                                <option value="0">خیر</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" role="tabpanel" id="tab-advance">
                                    <div class="form-group  row">
                                        <label class="col-sm-2 form-label" for="input-icon">استایل : </label>
                                        <div class="col-sm-10">
                                            <textarea dir="ltr" wire:model.defer="siteOption.custome_css" rows="10"
                                                      style="background: #333;color: #fff"
                                                      class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 form-label" for="input-icon">اسکریپت :</label>
                                        <div class="col-sm-10">
                                            <textarea dir="ltr" wire:model.defer="siteOption.custome_js" rows="10"
                                                      style="background: #333;color: #fff"
                                                      class="form-control"> </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div wire:ignore.self class="tab-pane fade" role="tabpanel" id="tab-license">
                                    <div class="form-group  row">
                                        <label class="col-sm-2 form-label pt-2" for="input-icon">کد فعال سازی سفارش : </label>
                                        <div class="col-sm-10">
                                            <input wire:model.defer="siteOption.license" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 form-label pt-2" for="input-icon">بررسی کد لایسنس
                                            : </label>
                                        <div class="col-sm-10">
                                            <button wire:click.prevent="CheckLicense" wire:loading.remove class="form-control">
                                                بررسی کد لایسنس
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 form-label pt-2" for="input-icon"></label>
                                        <div class="col-sm-10">
                                            @if($status == 1)
                                                <span style="color:green">لایسنس معتبر است .</span>
                                            @elseif($status == 0)
                                                <span style="color:red">لایسنس معتبر نیست .</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row -->
    </div>
</div>
@push('jsPanel')
    <script>
        $(function () {
            $("#picture1").on('click', function () {
                $("#fileinput1").trigger('click');
            });
        });
    </script>
    <script>
        $(function () {
            $("#picture2").on('click', function () {
                $("#fileinput2").trigger('click');
            });
        });
    </script>
    <script>
        $(function () {
            $("#picture3").on('click', function () {
                $("#fileinput3").trigger('click');
            });
        });
    </script>

@endpush
</div>
