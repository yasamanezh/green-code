<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <livewire:admin.layouts.head/>
</head>

<body class="main-body leftmenu">
<!-- Loader -->
<div id="global-loader">
    <img src="{{asset('admin/img/loader.svg')}}" class="loader-img" alt="لودر">
</div>

<div class="page ">
    <livewire:admin.layouts.sidbar/>
    <livewire:admin.layouts.header/>
    <div class="main-content side-content pt-0 overflow-x-hidden">
        {{$slot}}
    </div>

</div>
<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>
<livewire:admin.layouts.footer/>
</body>

</html>