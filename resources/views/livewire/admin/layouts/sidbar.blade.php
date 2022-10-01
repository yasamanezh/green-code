<!-- Sidemenu -->
<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class="sidemenu-logo">
        <a class="main-logo" href="{{route('Home')}}">
            <img src="/storage/{{$options->logo}}" class="header-brand-img desktop-logo" alt="لوگو">
        </a>
    </div>

    <div class="main-sidebar-body">
        <ul class="nav">
            @can('show_dashboard')
            <li class="nav-item  @if(Request::routeIs('Dashboard') ) active @endif">
                <a class="nav-link" href="{{route('Dashboard')}}"><span class="shape1"></span><span class="shape2"></span><i
                        class="ti-home sidemenu-icon"></i><span class="sidemenu-label">داشبورد</span></a>
            </li>
            @endcan
                @can('show_licence')
            <li class="nav-item  @if(Request::routeIs('Licences')  ||Request::routeIs('AddLicence')  ||Request::routeIs('EditLicence')) active @endif">
                <a class="nav-link" href="{{route('Licences')}}"><span class="shape1"></span><span class="shape2"></span><i
                        class="ti-lock sidemenu-icon"></i><span class="sidemenu-label">لایسنس ها</span></a>
            </li>
            @endcan


            <li class="nav-item  @if(Request::routeIs('blog')) active @endif">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span>
                    <span class="shape2"></span><i class="ti-receipt sidemenu-icon"></i><span class="sidemenu-label">وبلاگ</span><i
                        class="angle fe fe-chevron-left"></i></a>
                <ul class="nav-sub">
                    @can('show_blog')
                        <li class="nav-sub-item @if(Request::routeIs('Blogs.blog')) active @endif">
                            <a class="nav-sub-link" href="{{route('Blogs.blog')}}"> دسته بندی وبلاگ</a>
                        </li>
                    @endcan
                    @can('show_post')
                        <li class="nav-sub-item {{Request::routeIs('post.blog') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('post.blog')}}">پست ها</a></li>
                    @endcan
                    @can('show_comment')
                        <li class="nav-sub-item {{Request::routeIs('Coments') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('Coments')}}">دیدگاه ها</a></li>
                    @endcan

                </ul>
            </li>


            @can('show_demo')
                <li class="nav-item  @if(Request::routeIs('demoes') || Request::routeIs('demoAdd') || Request::routeIs('demoUpdate') || Request::routeIs('demoTrashed')  ) active @endif">
                    <a class="nav-link" href="{{route('demoes')}}"><span class="shape1"></span>
                        <span class="shape2"></span><i class="ti-palette sidemenu-icon"></i><span class="sidemenu-label">دموها</span></a>
                </li>
            @endcan

           @can('show_page')
                <li class="nav-item  @if(Request::routeIs('pages') || Request::routeIs('page.add') || Request::routeIs('page.add') || Request::routeIs('page.update') || Request::routeIs('page.trashed')  ) active @endif">
                    <a class="nav-link" href="{{route('pages')}}"><span class="shape1"></span>
                        <span class="shape2"></span><i class="ti-palette sidemenu-icon"></i><span class="sidemenu-label">برگه ها</span></a>
                </li>
            @endcan


            <li class="nav-item" @if(Request::routeIs('Users') || Request::routeIs('Roles')) active @endif>
                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i
                        class="si si-user sidemenu-icon"></i><span class="sidemenu-label">کاربران</span><i
                        class="angle fe fe-chevron-left"></i></a>
                <ul class="nav-sub">
                    @can('show_user')
                        <li class="nav-sub-item @if(Request::routeIs('Users')) active @endif">
                            <a class="nav-sub-link" href="{{route('Users')}}">فهرست کاربران</a>
                        </li>
                    @endcan
                    @can('show_role')
                        <li class="nav-sub-item @if(Request::routeIs('Roles')) active @endif">
                            <a class="nav-sub-link" href="{{route('Roles')}}">دسترسی ها</a>
                        </li>
                    @endcan

                </ul>
            </li>

            @can('show_option')
                <li class="nav-item  @if(  Request::routeIs('social.index')|| Request::routeIs('SiteOptions')) active @endif">
                    <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span>
                        <i class="ti-server sidemenu-icon"></i><span class="sidemenu-label">تنظیمات</span><i
                            class="angle fe fe-chevron-left"></i></a>
                    <ul class="nav-sub">

                        <li class="nav-sub-item {{Request::routeIs('SiteOptions') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('SiteOptions')}}">تنظیمات عمومی</a></li>
                        <li class="nav-sub-item {{Request::routeIs('social.index') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('social.index')}}">شبکه های اجتماعی</a></li>
                        <li class="nav-sub-item {{Request::routeIs('showContact') || Request::routeIs('contacts') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('contacts')}}">تماس با ما</a></li>

                    </ul>
                </li>
            @endcan

           @can('show_newsletter')
                <li class="nav-item  @if(Request::routeIs('newsletter.index')) active @endif">
                    <a class="nav-link" href="{{route('newsletter.index')}}"><span class="shape1"></span>
                        <span class="shape2"></span><i class="ti-email sidemenu-icon"></i><span class="sidemenu-label">خبرنامه</span></a>
                </li>
            @endcan
            @can('show_AdminLogs')
                <li class="nav-item  @if(Request::routeIs('AdminLogs')) active @endif">
                    <a class="nav-link" href="{{route('AdminLogs')}}"><span class="shape1"></span>
                        <span class="shape2"></span><i class="ti-bar-chart sidemenu-icon"></i><span class="sidemenu-label">رویدادها</span></a>
                </li>
            @endcan
           @can('show_tools')
            <li class="nav-item  @if(Request::routeIs('admin.tools')) active @endif">
                <a class="nav-link" href="{{route('admin.tools')}}"><span class="shape1"></span>
                    <span class="shape2"></span><i class="ti-settings sidemenu-icon"></i><span class="sidemenu-label">ابزار</span></a>
            </li>
         @endcan
        </ul>
    </div>
</div>
<!-- End Sidemenu -->
