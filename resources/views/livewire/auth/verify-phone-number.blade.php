<div>
    @section('title','وریفای کردن شماره موبایل')
    <section class="page-account-box">
        <form >
            @csrf
            <div class="col-lg-7 col-md-7 col-xs-12 mx-auto">
                <div class="account-box">
                    <a href="#" class="account-box-logo">digistore</a>
                    <div class="account-box-content">
                        <div class="message-light">
                            <div class="massege-light-send" wire:ignore >
                                برای شماره همراه {{request()->phone}} کد تایید ارسال گردید
                            </div>
                            <div class="account-box-verify-content">
                                <div class="form-account">
                                    <div class="form-account-title">کد فعال سازی پیامک شده را وارد کنید</div>
                                    <div class="form-account-row">
                                        <div class="lines-number-input">
                                            <input type="number" name="num1" class="line-number-account" maxlength="1"
                                                   wire:model.defer="num1">
                                            <input type="number" name="num2" class="line-number-account" maxlength="1"
                                                   wire:model.defer="num2">
                                            <input type="number" name="num3" class="line-number-account" maxlength="1"
                                                   wire:model.defer="num3">
                                            <input type="number" name="num4" class="line-number-account" maxlength="1"
                                                   wire:model.defer="num4">
                                            <input type="number" name="num5" class="line-number-account" maxlength="1"
                                                   wire:model.defer="num5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="loader" wire:loading wire:target="CheckCode"></div>
                            <div style="text-align: center;padding-top: 35px;">
                                <div id="timer" style="padding-bottom: 15px"></div>
                                <button class="btn btn-success ui-btn-lg" id="btn" type="button" wire:click.prefetch.prevent="CheckCode">تایید</button>
                            </div>
                            <script>
                                document.addEventListener('livewire:load', function () {
                                    var count = @this.distance;
                                    var counter = setInterval(timer, 1000); //1000 will  run it every 1 second
                                    function timer() {
                                        count = count - 1;
                                        if (count < 0) {
                                            /*clearInterval(counter);*/
                                            var btn = document.getElementById("btn");
                                            /*document.getElementById("timer").innerHTML='';*/
                                            /*btn.value = '{{request()->phone}}';*/
                                            btn.innerHTML = 'ارسال مجدد';
                                            return;
                                        }

                                        document.getElementById("timer").innerHTML = count + " ثانیه"; // watch for spelling
                                    }
                                })

                            </script>
                            {{--<script>
                                var timeleft = {{$distance}};
                                var downloadTimer = setInterval(function(){
                                    if(timeleft <= 0){
                                        clearInterval(downloadTimer);
                                        document.getElementById("countdown").innerHTML = "";
                                        var btn = document.getElementById("btn");
                                        btn.innerHTML = 'ارسال مجدد';
                                    } else {
                                        document.getElementById("countdown").innerHTML = timeleft + " ثانیه ";
                                    }
                                    timeleft -= 1;
                                }, 1000);
                            </script>--}}
                            <div class="account-footer">
                                <div class="account-footer">
                                    <span>کاربر جدید هستید؟</span>
                                    <a href="register.html" class="btn-link-register">ثبت‌نام در دیجی‌اسمارت</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <footer class="footer-light">
        <div class="container">
            <ul class="footer-light-link">
                <li><a href="#">درباره دیجی اسمارت</a></li>
                <li><a href="#">فرصت‌های شغلی</a></li>
                <li><a href="#">تماس با ما</a></li>
                <li><a href="#">همکاری با سازمان‌ها</a></li>
            </ul>

            <p class="title-footer">استفاده از مطالب فروشگاه اینترنتی دیجی‌اسمارت فقط برای مقاصد غیرتجاری و با ذکر منبع
                بلامانع است. کلیه حقوق این سایت متعلق به شرکت نوآوران فن آوازه (فروشگاه آنلاین دیجی‌اسمارت) می‌باشد.</p>

            <p class="copy-right-footer-light">Copyright © 2006 - 2019 DigiSmart.com</p>
        </div>
    </footer>
</div>
