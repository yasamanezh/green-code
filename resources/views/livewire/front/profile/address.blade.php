<div>
    <div class="container-main">
        <div class="col-12">
            <div class="breadcrumb-container  mt-2">
                <ul class="js-breadcrumb ">
                    <li class="breadcrumb-item">
                        <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('Profile')}}" class="breadcrumb-link">حساب کاربری من</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a  class="breadcrumb-link active-breadcrumb">آدرس ها</a>
                    </li>
                </ul>
            </div>
        </div>
        @include('livewire.front.profile.sidbar')
        <div class="col-lg-9 col-md-9 col-xs-12 pull-left">
            <section class="page-contents">
                <div class="profile-content">
                    <div class="headline-profile">
                        <span>آدرس ها</span>
                    </div>
                    <div class="profile-stats">
                        <div class="grid">
                            <div id="address-section">
                                <div class="profile-address-container mt-3">
                                    <button wire:click.prevent="AddAddress()" class="profile-address-add" data-toggle="modal" data-target="#exampleModalCenter">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        افزودن آدرس جدید
                                    </button>
                                </div>

                                <div class="profile-address-container user-address-container">
                                    @foreach($addresses as $address)
                                    <div class="profile-address-card">

                                        <div class="profile-address-card-desc">
                                            <h4 class="js-address-full-name">{{$address->name . ' '. $address->lname}} </h4>
                                            <p class="checkout-address-text">
                                                    <span class="js-address-address-part">
                                                        {{\App\Models\Country::where('id',$address->state)->pluck('name')->first()}}-
                                {{\App\Models\City::where('id',$address->city)->pluck('name')->first()}}

                                                         {{$address->address}}
                                                    </span>
                                            </p>
                                        </div>
                                        <div class="profile-address-card-data">
                                            <ul class="profile-address-card-methods">
                                                <li class="profile-address-card-method">
                                                    <i class="fa fa-envelope-o"></i>
                                                    کدپستی :
                                                    <span class="js-address-post-code">
                                                            {{$address->code_posti}}
                                                        </span>
                                                </li>
                                                <li class="profile-address-card-method">
                                                    <i class="fa fa-mobile"></i>
                                                    تلفن همراه :
                                                    <span class="js-address-post-code">
                                                             {{$address->mobile}}
                                                    </span>
                                                </li>
                                            </ul>
                                            <div class="profile-address-card-actions" >
                                                <button wire:click.prevent="deleteAddress({{$address->id}})" class="btn-note js-remove-address-btn" data-toggle="modal">حذف</button>
                                                <button  wire:click.prevent="editAdress({{ $address->id }})" class="btn-note js-edit-address-btn" data-toggle="modal">ویرایش</button>
                                            </div>
                                        </div>

                                    </div><br><br><br>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
    <!-- Modal -->
    <div  wire:ignore.self class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                         <span>ویرایش آدرس</span>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="middle-container">
                        <form action="#" class="form-checkout" wire:submit.prevent="updateAddress()">
                            <div class="form-checkout-row">
                                <label for="name">نام تحویل گیرنده <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="name" type="text" id="name" class="input-name-checkout form-control @error('name') is-invalid @enderror" placeholder="نام تحویل گیرنده را وارد نمایید">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="phone-number">شماره موبایل <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="mobile" type="text" id="phone-number" class="input-name-checkout form-control @error('mobile') is-invalid @enderror" placeholder="09xxxxxxxxx" style="text-align:left;">
                                @error('mobile')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div  class="form-checkout-valid-row">
                                    <label for="province">استان <span class="required-star"  style="color:red;"></span></label>
                                    <select wire:model="state" name="" id="province" class="form-control">
                                        <option value="date-desc" selected="selected">استان مورد نظر خود را انتخاب کنید
                                        </option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div  class="form-checkout-valid-row">
                                    <label for="city">شهر
                                        <span class="required-star" style="color:red;">*</span></label>
                                    <select wire:model.defer="city" name="" id="city" class="form-control">
                                        <option value="date-desc" selected="selected">شهر مورد نظر خود را انتخاب کنید</option>
                                        @if($state)
                                            @foreach(\App\Models\City::where('country_id',$state)->get() as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @error('city')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <label for="post-code">کد پستی<span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="code_posti" type="text" id="post-code" class="input-name-checkout form-control  @error('code_posti') is-invalid @enderror" placeholder="کد پستی را بدون خط تیره بنویسید">
                                @error('code_posti')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="address">آدرس
                                    <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="address" type="text" id="address" class="input-name-checkout form-control  @error('address') is-invalid @enderror" placeholder="آدرس خود را وارد نمایید" style="height:80px;">
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="AR-CR">
                                    <button class="btn-registrar">
                                         <span>ذخیره تغییرات</span>
                                        </button>
                                    <a href="#" class="cancel-edit-address" data-dismiss="modal" aria-label="Close">انصراف و بازگشت</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  wire:ignore.self class="modal fade" id="form1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>

                        <span>اضافه کردن آدرس جدید</span>

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="middle-container">
                        <form action="#" class="form-checkout" wire:submit.prevent="createAddress()">
                            <div class="form-checkout-row">
                                <label for="name">نام تحویل گیرنده <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="nameCreate" type="text" id="name" class="input-name-checkout form-control @error('nameCreate') is-invalid @enderror" placeholder="نام تحویل گیرنده را وارد نمایید">
                                @error('nameCreate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="phone-number">شماره موبایل <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="mobileCreate" type="text" id="phone-number" class="input-name-checkout form-control @error('mobileCreate') is-invalid @enderror" placeholder="09xxxxxxxxx" style="text-align:left;">
                                @error('mobileCreate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div  class="form-checkout-valid-row">
                                    <label for="province">استان <span class="required-star"  style="color:red;"></span></label>
                                    <select wire:model="stateCreate" name="" id="province" class="form-control">
                                        <option value="date-desc" selected="selected">استان مورد نظر خود را انتخاب کنید
                                        </option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('stateCreate')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div  class="form-checkout-valid-row">
                                    <label for="city">شهر
                                        <span class="required-star" style="color:red;">*</span></label>
                                    <select wire:model.defer="cityCreate" name="" id="city" class="form-control">
                                        <option value="date-desc" selected="selected">شهر مورد نظر خود را انتخاب کنید</option>
                                        @if($stateCreate)
                                            @foreach(\App\Models\City::where('country_id',$stateCreate)->get() as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @error('cityCreate')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <label for="post-code">کد پستی<span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="code_postiCreate" type="text" id="post-code" class="input-name-checkout form-control  @error('code_posti') is-invalid @enderror" placeholder="کد پستی را بدون خط تیره بنویسید">
                                @error('code_postiCreate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <label for="address">آدرس
                                    <span class="required-star" style="color:red;">*</span></label>
                                <input wire:model.defer="addressCreate" type="text" id="address" class="input-name-checkout form-control  @error('address') is-invalid @enderror" placeholder="آدرس خود را وارد نمایید" style="height:80px;">
                                @error('addressCreate')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <div class="AR-CR">
                                    <button class="btn-registrar">
                                            <span>ذخیره</span>
                                        </button>
                                    <a href="#" class="cancel-edit-address" data-dismiss="modal" aria-label="Close">انصراف و بازگشت</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  wire:ignore.self class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <span>حذف آدرس</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="middle-container">
                        <form action="#" class="form-checkout" >
                            <div class="form-checkout-row">
                                <div>ایا برای حذف ادرس اطمینان دارید؟</div>
                                <div class="AR-CR">
                                    <button class="btn-registrar" wire:click.prevent="delete()">
                                            <span>بله</span>
                                    </button>
                                    <a href="#" class="cancel-edit-address" data-dismiss="modal" aria-label="Close">خیر</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('jsPanel')
    <script>
        window.addEventListener('hide-form', event => {
            $('#form').modal('hide');
        })

        window.addEventListener('show-form', event => {
            $('#form').modal('show');
        })

        window.addEventListener('hide-form-modal', event => {
            $('#form1').modal('hide');
        })

        window.addEventListener('show-form-modal', event => {
            $('#form1').modal('show');
        })

        window.addEventListener('show-delete-modal', event => {
            $('#confirmationModal').modal('show');
        })

        window.addEventListener('hide-delete-modal', event => {
            $('#confirmationModal').modal('hide');
        })

    </script>
@endpush
