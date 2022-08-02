<div>
    <div class="col-md-4 col-sm-12 col-xs-12 pull-left">
        <div class="header-left">
            @if (auth()->check())
                <ul class="nav-lr">
                    <li class="nav-item-account margin-left" >
                        <a >
                            <img src="{{asset('/assets/images/user.png')}}" alt="user">
                            حساب کاربری
                            <div class="dropdown-menu">
                                <ul>
                                    @if($this->isAdmin())
                                        <li class="dropdown-menu-item">
                                            <a href="{{route('Dashboard')}}" class="dropdown-item">
                                                <i class="mdi mdi-account-card-details-outline"></i>
                                                پنل ادمین
                                            </a>
                                        </li>
                                    @endif
                                    <li class="dropdown-menu-item">
                                        <a href="{{route('Profile')}}" class="dropdown-item">
                                            <i class="mdi mdi-account-card-details-outline"></i>
                                            حساب کاربری من
                                        </a>
                                    </li>

                                    <li class="dropdown-menu-item">
                                        <a href="/logout" class="dropdown-item">
                                            <i class="mdi mdi-logout-variant"></i>
                                            خروج از حساب
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </li>
                </ul>
            @else
                <ul class="nav-lr">

                    <li class="nav-item-account margin-left">
                        <a href="/login">
                            <button class="btn btn-default-gray btn-block  btn-lg mt-1">
                                <i class="fa fa-sign-out"></i>
                                ورود / عضویت
                            </button>
                        </a>
                    </li>

                </ul>
            @endif
        </div>
    </div>
</div>
