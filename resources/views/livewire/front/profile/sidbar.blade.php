<div>
  <section class="page-aside">
            <div class="sidebar-wrapper">
                <div class="box-sidebar">
                    <div class="profile-box">
                        <div class="profile-box-avator">
                            <a href="#">
                                @if(isset(auth()->user()->avatar))
                                    <img src="/storage/{{auth()->user()->avatar}}">
                                @else
                                <img src="{{asset('assets/images/profile/user-profile.svg')}}">
                                @endif
                            </a>
                        </div>
                        <div class="profile-box-content">
                            <span class="profile-box-nameuser">{{auth()->user()->name}}</span>
                            <span class="profile-box-phone">شماره همراه :{{auth()->user()->phone}}</span>

                        </div>
                        <div class="profile-box-tabs">
                            <a href="{{route('Profile')}}" class="profile-box-tab">ویرایش اطلاعات</a>
                            <a href="/logout" class="profile-box-tab-sign-out">خروج از حساب</a>
                        </div>
                    </div>
                </div>
                <div class="box-sidebar">
                    <span class="box-header-sidebar">حساب کاربری شما</span>
                    <ul class="profile-menu-items">
                        <li>
                            <a href="{{route('Profile')}}" class="profile-menu-url  @if(Request::routeIs('Profile')) active-profile @endif">
                                <span class="mdi mdi-account-outline"></span>
                                پروفایل</a>
                        </li>
                        <li>
                            <a href="{{route('Orders')}}" class="profile-menu-url  @if(Request::routeIs('Orders')) active-profile @endif">
                                <span class="fa fa-shopping-basket"></span>
                                همه سفارش ها</a>
                        </li>
                        <li>
                            <a href="{{route('Wishlist')}}" class="profile-menu-url @if(Request::routeIs('Wishlist')) active-profile @endif">
                                <span class="fa fa-star-o"></span>
                                لیست علاقه مندی ها</a>
                        </li>
                        <li>
                            <a href="{{route('UserComment')}}" class="profile-menu-url @if(Request::routeIs('UserComment')) active-profile @endif">
                                <span class="fa fa-question"></span>
                                پرسش ها


                                 </a>

                        </li>

                        <li>
                            <a href="{{route('Download')}}" class="profile-menu-url @if(Request::routeIs('Download')) active-profile @endif">
                                <span class="mdi mdi-download"></span>
                               دانلودها</a>
                        </li>

                    </ul>
                </div>
            </div>
        </section>
</div>
