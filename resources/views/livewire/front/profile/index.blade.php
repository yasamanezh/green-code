<div>
    <!--profile------------------------------------>
    <div class="container-main">
        <div class="col-12">
            <div class="breadcrumb-container  mt-2">
                <ul class="js-breadcrumb ">
                    <li class="breadcrumb-item">
                        <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{route('Profile')}}" class="breadcrumb-link active-breadcrumb">حساب کاربری من</a>
                    </li>
                </ul>
            </div>
        </div>
        @include('livewire.front.profile.sidbar')
        <div class="col-lg-9 col-md-9 col-xs-12 pull-left">
            <section class="page-contents">
                <div class="profile-content">
                    <div class="headline-profile">
                        <span>اطلاعات شخصی</span>
                    </div>
                    <div class="profile-stats">
                        <div class="profile-stats-row">
                            <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                                <div class="profile-stats-col">
                                    <div class="profile-stats-content">
                                        <span class="profile-first-title"> نام و نام خانوادگی :</span>
                                        <span class="profile-second-title" >{{$user->name}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                                <div class="profile-stats-col">
                                    <div class="profile-stats-content">
                                        <span class="profile-first-title"> پست الکترونیک :</span>
                                        <span class="profile-second-title" >{{$user->email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                                <div class="profile-stats-col">
                                    <div class="profile-stats-content">
                                        <span class="profile-first-title"> شماره تلفن همراه :</span>
                                        <span class="profile-second-title"  >{{$user->phone}}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                                <div class="profile-stats-col">
                                    <div class="profile-stats-content">
                                        <span class="profile-first-title"> دریافت خبرنامه :</span>
                                        <span class="profile-second-title">بله</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="profile-stats-action">
                            <a href="" wire:click.prevent="shoeEdit()" class="link-spoiler-edit"><i class="fa fa-pencil"></i>ویرایش اطلاعات شخصی</a>
                        </div>
                    </div>
                </div>
                <div class="profile-content" style="display:block">
                    <div class="headline-profile">
                        <span>تغییر پسورد</span>
                    </div>
                    <div class="profile-stats">
                        <div class="profile-stats-row">
                            <fieldset class="form-legal-fieldset">
                                <div class="form-legal-center">
                                    <div class="profile-stats-col">
                                        <div class="profile-stats-content">
                                        <span class="profile-first-title"> رمز عبور قبلی :</span>
                                        <input wire:model.defer="state.current_password" type="password" class="ui-input-field @error('current_password') is-invalid @enderror" id="currentPassword" placeholder=" رمز عبور قبلی ">
                                        @error('current_password')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                                <div class="form-legal-center">
                                    <div class="profile-stats-col">
                                        <div class="profile-stats-content">
                                            <span class="profile-first-title">رمز عبور جدید :</span>
                                        <input wire:model.defer="state.password" type="password" class="ui-input-field @error('password') is-invalid @enderror" id="newPassword" placeholder=" رمز عبور جدید">
                                        @error('password')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                                <div class="form-legal-center">
                                    <div class="profile-stats-col">
                                        <div class="profile-stats-content">
                                            <span class="profile-first-title"> تکرار رمز عبور جدید :</span>
                                        <input wire:model.defer="state.password_confirmation" type="password" class="ui-input-field @error('password_confirmation') is-invalid @enderror" id="passwordConfirmation" placeholder=" تکرار رمز عبور جدید">
                                        @error('password_confirmation')
                                        <div class="invalid-feedback" style="display: block;">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="col-12" style="padding:0;">
                            <div class="profile-stats-row form-legal-row-submit">
                                <div class="parent-btn parent-store">
                                    <button class="dk-btn dk-btn-info btn-store" wire:click="changePassword">
                                        ذخیره پسورد جدید
                                        <i class="fa fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        <i class="mdi mdi-account-outline" aria-hidden="true"></i>
                        ویرایش اطلاعات
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="middle-container">
                        <form action="#" class="form-checkout">
                            <div class="form-checkout-row">

                                <label >نام و نا خانوادگی: <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="user.name" type="text" class="input-name-checkout form-control" placeholder="نام و نا خانوادگی را وارد کنید. ">
                                <label >موبایل :
                                    <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="user.phone" type="text"  class="input-name-checkout form-control" placeholder="شماره موبایل  خود را وارد نمایید" >
                                   <label for="address">ایمیل : </label>
                                <input wire:model.defer="user.email" type="text"  class="input-name-checkout form-control" placeholder="ایمیل  خود را وارد نمایید" >
                                <div class="AR-CR">
                                    <button class="btn-registrar" wire:click.prevent="updateUser()">ویرایش</button>
                                    <a href="#" class="cancel-edit-address" data-dismiss="modal" aria-label="Close">انصراف و بازگشت</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('jsBeforMain')
    <!--main----------------------------------------->
    <script>

        $(document).ready(function () {

            window.addEventListener('hide-form', event => {
                $('#exampleModalCenter').modal('hide');
            })
             window.addEventListener('show-form', event => {
                $('#exampleModalCenter').modal('show');
            })



        });

    </script>
@endpush
