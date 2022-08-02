<x-guest-layout>
    <div class="container-main">
        <div class="col-12">
            <div class="semi-modal-layout">
                <section class="page-account-box">
                    <div class="col-lg-7 col-md-7 col-xs-12 mx-auto">
                        <div class="account-box" style="padding-bottom:40px;">
                            @php $logo='/storage/'.\App\Models\SiteOption::pluck('logo')->first() @endphp
                            <a href="{{route('Home')}}" >
                                <img src="{{$logo}}" style="width: 156px;height: 60px;background-size: contain;text-indent: -1000em;position: absolute;right: 0;left: 0;margin: 15px auto 0;outline: none;" alt="لوگو">
                            </a>
                            <div class="account-box-headline">
                                <a href="/login" class="login-ds">ورود</a>
                                <a href="/register" class="register-ds active-account">ثبت نام</a>
                            </div>
                            <x-jet-validation-errors class="mb-4"/>
                            <div class="account-box-content">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-account-title">
                                        <label for="name-phone">نام و نام خانوادگی</label>
                                        <input type="text" class="number-email-input" name="name"
                                               value="{{old('name')}}" required autofocus autocomplete="name"
                                               placeholder=" نام و نام خانودگی خود را وارد نمایید"
                                               style="text-align: right;">
                                        <span class="mdi mdi-account-outline"></span>
                                    </div>
                                    <div class="form-account-title">
                                        <label for="name-phone">ایمیل</label>
                                        <input type="text" class="number-email-input" name="email" id="email"
                                               value="{{old('email')}}"
                                               placeholder="example@gmail.com"
                                               style="text-align: right;">
                                        <span class="mdi mdi-email"></span>
                                    </div>
                                    <div class="form-account-title">
                                        <label for="email-phone">شماره موبایل</label>
                                        <input type="number" class="number-email-input"
                                               placeholder="0917*******" type="phone" name="phone"
                                               value="{{old('phone')}}" required>
                                        <span class="mdi mdi-phone"></span>
                                    </div>
                                    <div class="form-account-title">
                                        <label for="password">کلمه عبور</label>
                                        <input id="password" class="password-input"
                                               placeholder="کلمه عبور خود را وارد نمایید" type="password"
                                               name="password" required autocomplete="new-password">
                                        <span class="mdi mdi-lock"></span>
                                    </div>
                                    <div class="form-account-title">
                                        <label for="password">تکرار کلمه عبور</label>
                                        <input id="password_confirmation" class="password-input"
                                               placeholder="کلمه عبور خود را وارد نمایید"
                                               type="password" name="password_confirmation" required
                                               autocomplete="new-password">
                                        <span class="mdi mdi-lock"></span>
                                    </div>
                                    <div class="form-auth-row">
                                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                            <div class="mt-4">
                                                <x-jet-label for="terms">
                                                    <div class="flex items-center">
                                                        <x-jet-checkbox name="terms" id="terms"/>
                                                        <div class="ml-2">
                                                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                </x-jet-label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="parent-btn lr-ds">
                                        <button type="submit" class="dk-btn dk-btn-info">
                                            ثبت نام در سایت
                                            <i class="fa fa-sign-in sign-in"></i>
                                        </button>
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

