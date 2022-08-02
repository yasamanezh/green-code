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
            <li class="nav-item  @if(Request::routeIs('Dashboard')) active @endif">
                <a class="nav-link" href="{{route('Dashboard')}}"><span class="shape1"></span><span class="shape2"></span><i
                        class="ti-home sidemenu-icon"></i><span class="sidemenu-label">داشبورد</span></a>
            </li>
            @endcan

            <li class="nav-item @if(Request::routeIs('AddBrand') ||Request::routeIs('AddCategory') || Request::routeIs('Products') ||   Request::routeIs('EditProduct') || Request::routeIs('categories')
                  || Request::routeIs('EditCategory')|| Request::routeIs('Filters')||
                   Request::routeIs('AttributeGroups')||  Request::routeIs('EditAttributeGroup') ||
                     Request::routeIs('Trashed') ||   Request::routeIs('AddProduct') || Request::routeIs('Editbrand') ||Request::routeIs('editFilter') || Request::routeIs('AddFilter')
                       || Request::routeIs('ProductComment') || Request::routeIs('Questions')|| Request::routeIs('editQuestion')) active @endif">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i
                        class="ti-package sidemenu-icon"></i><span class="sidemenu-label">محصولات</span><i
                        class="angle fe fe-chevron-left"></i></a>
                <ul class="nav-sub">
                    @can('show_category')
                        <li class="nav-sub-item @if(Request::routeIs('categories') ||Request::routeIs('AddCategory') || Request::routeIs('EditCategory') ||   Request::routeIs('Trashed')) active @endif">
                            <a class="nav-sub-link" href="{{route('categories')}}">دسته بندی محصولات</a>
                        </li>
                    @endcan
                    @can('show_brand')
                        <li class="nav-sub-item  @if(Request::routeIs('Manufacturers') || Request::routeIs('AddBrand') || Request::routeIs('Editbrand')  ) active @endif">
                            <a class="nav-sub-link" href="{{route('Manufacturers')}}">برندها </a>
                        </li>
                    @endcan
                    @can('show_attr')
                        <li class="nav-sub-item  @if(Request::routeIs('AttributeGroups') || Request::routeIs('EditAttributeGroup')  ) active @endif">
                            <a class="nav-sub-link" href="{{route('AttributeGroups')}}">گروه مشخصات </a>
                        </li>
                    @endcan

                    @can('show_garranty')
                        <li class="nav-sub-item  {{Request::routeIs('warrantys') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('warrantys')}}">پشتیبانی</a></li>
                    @endcan
                    @can('show_product')
                        <li class="nav-sub-item  @if(Request::routeIs('Products') ||    Request::routeIs('EditProduct') ||   Request::routeIs('AddProduct')    ) active @endif">
                            <a class="nav-sub-link" href="{{route('Products')}}">محصولات</a>
                        </li>
                         <li class="nav-sub-item  @if(Request::routeIs('NoProducts')  ) active @endif">
                            <a class="nav-sub-link" href="{{route('NoProducts')}}">لیست اطلاع از موجودی</a>
                        </li>

                        <li class="nav-sub-item {{Request::routeIs('ProductComment') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('ProductComment')}}">دیدگاه ها</a></li>
                        <li class="nav-sub-item {{Request::routeIs('Questions') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('Questions')}}">پرسش ها</a></li>

                    @endcan
                    @can('show_filter')
                        <li class="nav-sub-item  @if(Request::routeIs('Filters') ||Request::routeIs('editFilter') || Request::routeIs('AddFilter') ) active @endif">
                            <a class="nav-sub-link" href="{{route('Filters')}}">فیلترها</a>
                        </li>
                    @endcan

                </ul>
            </li>
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
            @can('show_design')
                <li class="nav-item  @if(Request::routeIs('Proposals') ||Request::routeIs('ProposalUpdate') || Request::routeIs('ProposalAdd') ||Request::routeIs('Modules') || Request::routeIs('carsouls') || Request::routeIs('carsoulAdd')
                  ||Request::routeIs('Htmls') || Request::routeIs('updateHtml') || Request::routeIs('AddHtml') || Request::routeIs('carsouledit') ||Request::routeIs('slider.add') ||Request::routeIs('slider.update') || Request::routeIs('ads.index') ||Request::routeIs('HomeDesign') ||Request::routeIs('banner.index') || Request::routeIs('slider.index')
             ) active @endif">
                    <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span>
                        <i class="ti-write sidemenu-icon"></i><span class="sidemenu-label">طراحی </span><i
                            class="angle fe fe-chevron-left"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item {{Request::routeIs('banner.index') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('banner.index')}}">بنرها</a></li>
                        <li class="nav-sub-item {{Request::routeIs('Htmls') || Request::routeIs('updateHtml') || Request::routeIs('AddHtml')  ? 'active': '' }}"><a class="nav-sub-link" href="{{route('Htmls')}}">html</a></li>
                        <li class="nav-sub-item {{Request::routeIs('Modules') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('Modules')}}">صفحه اصلی سایت</a></li>


                    </ul>
                </li>
            @endcan
                @can('show_discount')
                    <li class="nav-item  @if(Request::routeIs('discounts') ||Request::routeIs('AddDiscount') ||Request::routeIs('EditDiscount')) active @endif">
                        <a class="nav-link" href="{{route('discounts')}}"><span class="shape1"></span><span class="shape2"></span><i
                                class="ti-face-smile sidemenu-icon"></i><span class="sidemenu-label">تخفیف ها</span></a>
                    </li>
                @endcan



            @can('show_option')
                <li class="nav-item  @if( Request::routeIs('Menus')|| Request::routeIs('social.index')|| Request::routeIs('FooterOptions')|| Request::routeIs('SiteOptions')) active @endif">
                    <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span>
                        <i class="ti-server sidemenu-icon"></i><span class="sidemenu-label">تنظیمات</span><i
                            class="angle fe fe-chevron-left"></i></a>
                    <ul class="nav-sub">

                        <li class="nav-sub-item {{Request::routeIs('FooterOptions') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('FooterOptions')}}">تنظیمات فوتر</a></li>
                        <li class="nav-sub-item {{Request::routeIs('SiteOptions') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('SiteOptions')}}">تنظیمات عمومی</a></li>
                        <li class="nav-sub-item {{Request::routeIs('Menus') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('Menus')}}">تنظیمات منو</a></li>
                        <li class="nav-sub-item {{Request::routeIs('social.index') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('social.index')}}">شبکه های اجتماعی</a></li>
                        <li class="nav-sub-item {{Request::routeIs('showContact') || Request::routeIs('contacts') ? 'active': '' }}"><a class="nav-sub-link" href="{{route('contacts')}}">تماس با ما</a></li>

                    </ul>
                </li>
            @endcan
            @can('show_order')
                <li class="nav-item" @if(Request::routeIs('AdminDetailOrder')|| Request::routeIs('admin.orders.index')) active @endif>
                    <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i
                            class="si si-wallet sidemenu-icon"></i><span class="sidemenu-label">سفارشات و پرداخت ها</span><i
                            class="angle fe fe-chevron-left"></i></a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item @if(Request::routeIs('admin.orders.index') || Request::routeIs('AdminDetailOrder')  ) active @endif">
                            <a class="nav-sub-link" href="{{route('admin.orders.index')}}">سفارشات</a>
                        </li>

                        <li class="nav-sub-item @if(Request::routeIs('AdminPayment')  ) active @endif">
                            <a class="nav-sub-link" href="{{route('AdminPayment')}}">پرداخت ها</a>
                        </li>
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
            @can('show_notification')
            <li class="nav-item" @if(Request::routeIs('EmailNotification')) active @endif>
                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i
                        class="si si-notebook sidemenu-icon"></i><span class="sidemenu-label">اطلاع رسانی</span><i
                        class="angle fe fe-chevron-left"></i></a>
                <ul class="nav-sub">
                        <li class="nav-sub-item @if(Request::routeIs('EmailNotification') || Request::routeIs('AddEmailNotification') || Request::routeIs('EditEmailNotification') ) active @endif">
                            <a class="nav-sub-link" href="{{route('EmailNotification')}}">ایمیل</a>
                        </li>

                        <li class="nav-sub-item @if(Request::routeIs('SmsNotification') ||Request::routeIs('AddSmsNotification') ||Request::routeIs('editSmsNotification')  ) active @endif">
                            <a class="nav-sub-link" href="{{route('SmsNotification')}}">پیامک</a>
                        </li>


                </ul>
            </li>
            @endcan
           @can('show_tools')
            <li class="nav-item  @if(Request::routeIs('admin.tools')) active @endif">
                <a class="nav-link" href="{{route('admin.tools')}}"><span class="shape1"></span>
                    <span class="shape2"></span><i class="ti-settings sidemenu-icon"></i><span class="sidemenu-label">ابزار</span></a>
            </li>
         @endcan
           @can('show_update')
            <li class="nav-item  @if(Request::routeIs('admin.update')) active @endif">
                <a class="nav-link" href="{{route('admin.update')}}"><span class="shape1"></span>
                    <span class="shape2"></span><i class="ti-briefcase sidemenu-icon"></i><span class="sidemenu-label">اپدیت</span></a>
            </li>
         @endcan

        </ul>
    </div>
</div>
<!-- End Sidemenu -->
