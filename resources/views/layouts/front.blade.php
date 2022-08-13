<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="{{asset('js/front.js')}}"></script>

    {!! app('seotools')->generate() !!}

    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/materialdesignicons.css')}}" />
    <!--    bootstrap------------------------------->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}" />
    <!--    responsive------------------------------>
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <livewire:front.layouts.head/>
</head>
<body>
<livewire:front.layouts.header/>
<div class="container-xxl bg-white p-0">
<!--header------------------------------------->
{{$slot}}
 <livewire:front.layouts.footer />
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('assets/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/lib/isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/lib/lightbox/js/lightbox.min.js')}}"></script>


<!--countdown------------------------------------>
@stack('jsBeforMain')
<!--main----------------------------------------->
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/lib/main.js')}}"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('jsPanel')

<livewire:scripts />

<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>

</body>

</html>
