<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ورود - ثبت نام</title>
    <script src="{{asset('js/front.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/materialdesignicons.css')}}" />

    <!--    bootstrap------------------------------->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}" />
    <!--    owl.carousel---------------------------->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}" />
    <!--    fancybox-------------------------------->
    <link rel="stylesheet" href="{{asset('assets/css/fancybox.min.css')}}">
    <!--    responsive------------------------------>
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-slider.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/noUISlider.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}" />
</head>
<body>
{{$slot}}
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
</body>

</html>
