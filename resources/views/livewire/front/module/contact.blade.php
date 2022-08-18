
<div>

    <div class="container-xxl">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">

                <div class="col-lg-12">
                    <!-- blog Start -->
                    <div class="container-xxl contact-us " style="direction: ltr">
                        <div class="row rtl">
                            <div class="col-sm-12">
                                <div class="page-content-contact-us">
                                    <h1 class="page-content-contact-us-title">تماس با
                                        @if($options->name) {{$options->name}} @else ما @endif

                                    </h1>
                                    <div class="page-content-contact-us-row">
                                        <div class="col-lg-8 col-md-8 col-xs-12 pull-right">
                                            <div class="page-content-contact-us-col-big">
                                                <p class="page-content-contact-us-full-paragraph">

                                                    کاربر گرامی، لطفاً در صورت وجود هرگونه سوال یا ابهامی،
                                                    از طریق فرم زیر  با ما تماس بگیرید.
                                                </p>
                                                <br>
                                                <br>
                                                <div class="page-content-contact-us-row-col">
                                                    <form action="#" class="contact-us-form">
                                                        <div class="contact-us-form-body">
                                                            <div class="form-legal-item">
                                                                <label for="#" class="form-legal-label">
                                                                    نام و نام‌خانوادگی
                                                                    <span class="required-star" style="color:red;">*</span>
                                                                </label>
                                                                <input wire:model.defer="contact.name" type="text" class="ui-input-field form-control" value="نام و نام خانوادگی">
                                                                @error('contact.name')
                                                                <div class="invalid-feedback display-block">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-legal-item">
                                                                <label for="#" class="form-legal-label">
                                                                    ایمیل
                                                                    <span class="required-star" style="color:red;">*</span>
                                                                </label>
                                                                <input wire:model.defer="contact.email" type="text" class="ui-input-field form-control" placeholder="example@gmail.com">
                                                                @error('contact.email')
                                                                <div class="invalid-feedback display-block">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-legal-item">
                                                                <label for="#" class="form-legal-label">
                                                                    متن پیام
                                                                    <span class="required-star" style="color:red;">*</span>
                                                                </label>
                                                                <textarea wire:model.defer="contact.content" name="" id="" cols="30" rows="10" class="ui-textarea-field form-control"></textarea>
                                                                @error('contact.content')
                                                                <div class="invalid-feedback display-block">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group mt-4 mb-4">
                                                                    <div class="captcha">
                                                                        <span>{!! captcha_img() !!}</span>
                                                                        <button wire:click.prevent="reloadCaptcha()" type="button" class="btn btn-danger" class="reload" id="reload">
                                                                            &#x21bb;
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group mb-4">
                                                                    <input id="captcha" type="text" class="form-control" placeholder="کد امنیتی را وارد کنید." name="captcha" wire:model.defer="captcha">
                                                                </div>
                                                                @error('captcha')
                                                                <span class="is-invalid">{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="upload-drag-uploaded-and-submit">
                                                                <button type="submit" wire:click.prevent="saveInfo" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">ثبت اطلاعات</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-12 pull-left">
                                            <div class="page-content-contact-us-image-container text-left">
                                                <img src="{{asset('assets/images/footer/page-contact-us.svg')}}" alt="تماس با ما">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


