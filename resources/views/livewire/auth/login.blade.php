<x-guest-layout>
    <div class="container-main mb-2">
        <div class="col-12">
            <div class="semi-modal-layout">
                <section class="page-account-box">
                    <div class="col-lg-7 col-md-7 col-xs-12 mx-auto">
                        <div class="account-box">
                            @php $logo='/storage/'.\App\Models\SiteOption::pluck('logo')->first() @endphp
                            <a href="{{route('Home')}}" >
                                <img src="{{$logo}}" style="width: 156px;height: 60px;background-size: contain;text-indent: -1000em;position: absolute;right: 0;left: 0;margin: 15px auto 0;outline: none;" alt="لوگو">
                            </a>
                            <div class="account-box-headline">
                                <a href="/login" class="login-ds active-account">ورود</a>
                                <a href="/register" class="register-ds">ثبت نام</a>
                            </div>
                            <div class="account-box-content">
                                <x-jet-validation-errors class="mb-4"/>
                                @if (session('status'))
                                    <div class="mb-4 font-medium text-sm text-green-600">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form method="POST" class="form-account" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-account-title">
                                        <label for="email-phone">شماره موبایل</label>
                                        <input class="number-email-input" id="phone"
                                               placeholder=" شماره موبایل یا ایمیل خود را وارد نمایید" type="text"
                                               name="auth" required autofocus>
                                        <span class="mdi mdi-phone"></span>
                                    </div>
                                    <div class="form-account-title">
                                        <label for="password">رمز عبور</label>
                                        <input type="password" class="password-input"
                                               placeholder="رمز عبور خود را وارد نمایید" name="password" required
                                               autocomplete="current-password">
                                        <span class="mdi mdi-lock"></span>
                                    </div>
                                    <div class="form-auth-row">
                                        <label for="#" class="ui-checkbox">
                                            <input type="checkbox" value="1" name="remember" id="remember">
                                            <span class="ui-checkbox-check"></span>
                                        </label>
                                        <label for="remember" class="remember-me">مرا به خاطر داشته باش</label>
                                    </div>
                                    <div class="parent-btn lr-ds">
                                        <button class="dk-btn dk-btn-info" type="submit">
                                            ورود به سایت
                                            <i class="fa fa-sign-in sign-in"></i>
                                        </button>
                                    </div>
                                    <div class="forget-password">
                                        <a href="{{ route('password.request') }}" class="account-link-password">رمز خود
                                            را فراموش کرده ام</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-guest-layout>
