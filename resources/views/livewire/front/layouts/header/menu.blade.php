<div>
    <!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="{{route('Home')}}" class="navbar-brand p-0">
                <h1 class="m-0"><i class="fa fa-code me-2"></i>گرین<span class="fs-5">کد</span></h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse" style="margin-right: 20%;">
                <div class="navbar-nav ms-auto py-0">
                    <a href="/packages" class="nav-item nav-link">پکیج ها</a>
                    @foreach($menus as $menu)
                        @if($this->linkPage($menu->link)[0] == 0)
                            <a href="{{route('FrontBlog')}}" class="nav-item nav-link">{{$menu->title}}</a>
                            @elseif(isset($this->linkPage($menu->link)[1]))
                              <a href="{{route($this->linkPage($menu->link)[0],$this->linkPage($menu->link)[1])}}" class="nav-item nav-link">{{$menu->title}}</a>
                            @else
                            <a href="{{route($this->linkPage($menu->link)[0])}}" class="nav-item nav-link">{{$menu->title}}</a>
                        @endif
                    @endforeach
                </div>
                @if(auth()->user())
                <a href="/dashboard/profile" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3"> حساب کاربری</a>
                @else
                <a href="/login" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">ورود/عضویت</a>
                @endif
            </div>
        </nav>

        <div class="container-xxl py-5 bg-primary hero-header mb-5">
            <div class="container my-5 py-5 px-lg-5">
                <div class="row g-5 py-5">

                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->
</div>

