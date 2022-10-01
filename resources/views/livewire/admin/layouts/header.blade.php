<div>
    <!-- Main Header-->
    <div class="main-header side-header sticky" style="top: 0">
        <div class="container-fluid">
            <div class="main-header-right">
                <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
            </div>
            <div class="main-header-right">
                <div class="dropdown d-md-flex">
                    <a class="nav-link icon full-screen-link" href="#">
                        <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                        <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                    </a>
                </div>

                <div class="main-header-notification">
                    <a class="nav-link icon" wire:click="deleteMessage()">
                        <i class="fe fe-message-square header-icons"></i>
                        <span class="badge badge-success nav-link-badge">{{count($messages)}}</span>
                    </a>
                </div>
                <div class="dropdown main-profile-menu">
                    <a class="d-flex" href="#">
                        <span class="main-img-user">
                           @if(isset(auth()->user()->avatar))
                                <img src="/storage/{{auth()->user()->avatar}}">
                            @else
                                <img src="{{asset('assets/images/profile/user-profile.svg')}}">
                            @endif
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading">
                            <h6 class="main-notification-title">{{auth()->user()->name}}</h6>
                            @if(auth()->user()->role == 'admin')
                            <p class="main-notification-text">ادمین </p>
                            @endif
                        </div>
                        @can('show_user')
                            <a class="dropdown-item border-top" href="/admin/profile">
                                <i class="fe fe-user"></i>حساب کاربری
                            </a>
                        @endcan
                         <a class="dropdown-item border-top" href="/logout">
                            <i class="fe fe-power"></i> خروج از سیستم
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
