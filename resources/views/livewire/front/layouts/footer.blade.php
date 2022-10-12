<div>
    <footer class="footer-light">
        <div class="container rtl-dir">
            <div class="row g-custom-x">
                <div class="col-lg-4">
                    <a href="{{ route('Home') }}">
                        <img src="images/logo.png" alt=""/>
                        <div class="spacer-20"></div>
                        <p style="text-align: justify">یک شرکت طراحی سایت حرفه ای و موفق از مجموعه ای از افراد جوان و
                            متخصص تشکیل شده است.به این می بالیم و مفتخریم که جمعی از کارشناسان، نخبگان و مدیران با تجربه
                            در حوزه طراحی سایت و دیجیتال مارکتینگ را در گرین کد داریم و با وجود این تیم خلاق و پرانرژی،
                            بهترین پشتیبانی را در سریعترین زمان به مشتریان عزیز خود ارائه می دهیم.</p>
                    </a>
                    <div class="spacer-10"></div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="widget">
                                <h5>صفحات سایت</h5>
                                <ul>
                                    <li><a href="{{ route('Home') }}">خانه</a></li>
                                    <li><a href="{{ route('services') }}">طراحی سایت</a></li>
                                    <li><a href="{{ route('about') }}">درباره ما</a></li>
                                    <li><a href="{{ route('contact') }}">تماس با ما</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="widget">
                                <h5>خدمات</h5>
                                <ul>
                                    <li><a href="#">طراحی وب سایت</a></li>
                                    <li><a href="#">طراحی لوگو</a></li>
                                    <li><a href="#">طراحی بنر</a></li>
                                    <li><a href="#">کلیپ های تبلیغاتی</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget">
                        <h5>خبر نامه</h5>
                        <p>با عضویت در خبرنامه از آخرین اخبار سایت با خبر شوید.</p>
                        <form action="blank.php" class="row form-dark" id="form_subscribe" method="post"
                              name="form_subscribe">
                            <div class="col text-center">
                                @if($success)
                                    <div class="success">
                                        ایمیل شما در خبرنامه سایت گرینکد ذخیره شد.
                                    </div>
                                    <br>
                                @endif
                                <input wire:model.defer="email" class="form-control" id="txt_subscribe"
                                       name="txt_subscribe" placeholder="ایمیل خود را وارد کنید." type="text"/>


                                <a wire:click.prevent="saveEmail()" id="btn-subscribe"><i
                                        class="arrow_right bg-color-secondary"></i></a>
                                <div class="clearfix"></div>
                                @error('email')
                                <br>
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </form>
                        <div class="spacer-10"></div>
                        <div class="spacer-30"></div>
                        <div class="widget">
                            <h5>شبکه های اجتماعی</h5>
                            <div class="social-icons">
                                <a href="https://www.instagram.com/green_code_ir/" target="_blank"><i class="fa fa-instagram fa-lg"></i></a>
                                <a href="https://wa.me/09384054988" target="_blank"><i class="fa fa-whatsapp fa-lg"></i></a>
                                <a href="https://wa.me/09199041290" target="_blank"><i class="fa fa-whatsapp fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="subfooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex">
                            <div class="de-flex-col">
                                <a href="#">
                                    Copyright 2022 - Green-Code by Green-Code.ir
                                </a>
                            </div>
                            <ul class="menu-simple">
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
