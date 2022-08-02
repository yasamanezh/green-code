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
                <div class="dropdown main-header-notification">
                    <a class="nav-link icon" href="#">
                        <i class="fe fe-bell header-icons"></i>
                        <span class="badge badge-danger nav-link-badge">{{count($notifications)}}</span>
                    </a>
                    @if(count($notifications) >=1)
                    <div class="dropdown-menu">
                        <div class="main-notification-list">
                            @if(count($orders) >=1)
                            <div class="media"  wire:click.prevent="deleteOrders()">
                               <div class="media-body">
                                    <strong> شما {{count($orders)}} سفارش جدید دارید</strong>
                                </div>
                            </div>
                            @endif
                            @if(count($register) >=1)
                            <div class="media" wire:click.prevent="deleteUser()">
                               <div class="media-body">
                                    <span>شما<strong class="text-success">  {{count($register)}} </strong>کاربر جدید دارید</span>
                                </div>
                            </div>
                            @endif
                            @if(count($comments) >=1)
                            <div class="media" wire:click.prevent="deleteComment()">
                               <div class="media-body">
                                    <strong> شما {{count($comments)}}دیدگاه جدید دارید</strong>
                                </div>
                            </div>
                            @endif
                            @if(count($questions) >=1)
                            <div class="media" wire:click.prevent="deleteQuestion()">
                               <div class="media-body">
                                    <strong> شما {{count($questions)}} پرسش جدید دارید</strong>
                                </div>
                            </div>
                            @endif
                            @if(count($comment_product) >=1)
                            <div class="media" wire:click.prevent="deleteCommentProduct()">
                               <div class="media-body">
                                    <strong> شما {{count($comment_product)}} نظر جدید برای محصولات دارید</strong>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                    @endif
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
