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
<style>
    html {
        overflow-x: hidden !important;
    }
    body{
        overflow-x: hidden !important;
    }
        .back-to-top {
            left: 40px !important;
            right: auto;

        }
        .mr-3{
            margin-right: 40px !important;
        }
        .chat-online {
            z-index: 1000000;
            right:40px;
            bottom: 20px;
            position: fixed !important;
            bottom: 93px;
        }
        .message-button {
            animation: ripple-red 1s linear infinite;
            width: 70px;
            position: absolute;
            height: 70px;
            right: 0;
            background-image:linear-gradient(
                to right,
                #86f532,
                #7ce82a,
                #46db21,
                #69cb16,
                #39bb01
            ) !important;
            border-radius: 50px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .item-message-chat-container {
            background: white;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            padding: 23px;
            transition: 0.2s;
        }
        .item-message-chat div {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            opacity: 0;
            justify-content: center;
            align-items: center;
            transform: translateX(40px);
            transition: transform 0.3s;
            display: flex;
        }

        .item-message-chat div.active {
            opacity: 1;
            transform: translateX(0px);
        }
        .item-message-chat div.next {
            opacity: 1;
            transform: translateX(-40px);
        }
        .box-icon-chat {
            width: 260px;
            position: absolute;
            bottom: 10px;
            right: 10px;
            border-radius: 6px;
            border-radius: 6px;
            padding-bottom: 7px;
            background: white;
            box-shadow: 5px 10px 18px #888888;
        }
        .box-icon-chat::after {
            content: '';
            position: absolute;
            bottom: -8px;
            right: 16px;
            left: auto;
            display: inline-block !important;
            border-right: 8px solid transparent;
            border-top: 8px solid #ffffff;
            border-left: 8px solid transparent;
        }
        .box-icon-chat ul li {
            padding: 15px 0px 15px 33px;
        }
        .box-icon-chat ul li a:first-child {
            line-height: 0.9;
        }
        .box-icon-chat ul li:hover {
            background-color: #f0f0f0;
        }

        .box-title-chat {
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            padding: 13px;
            text-align: center;
            background-image: linear-gradient(
                to right,
                #86f532,
                #7ce82a,
                #46db21,
                #69cb16,
                #39bb01
            ) !important;
        }

        .box-icon-chat a {
            position: relative;
            padding-right: 57px;
        }
        .box-icon-chat small {
            color: #787878;
        }
        .box-icon-chat ul li span {
            position: absolute;
            right: 0;
            top: 50%;
            margin-top: -20px;
            display: block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #0084ff;
            margin-right: 10px;
            color: #ffffff;
            text-align: center;
            vertical-align: middle;
        }

        .box-icon-chat ul li span svg {
            width: 24px;
            height: 24px;
            vertical-align: middle;
            text-align: center;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -12px;
            margin-left: -12px;
        }

        .box-titlt-close a {
            padding: 0;
            color: white;
        }
        .box-titlt-close a i {
            transition: all 0.2s;
            display: block;
        }

        .box-titlt-close {
            background-image: linear-gradient(
                to right,
                #86f532,
                #7ce82a,
                #46db21,
                #69cb16,
                #39bb01
            ) !important;
            padding: 6px;
            padding-top: 8px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            right: 0;
            top: -37px;
            position: absolute;
        }
        .box-titlt-close:hover a i {
            transform: rotate(180deg);
        }
        .box-icon-chat {
            display: block;
            visibility: hidden;
            opacity: 0;
            transition: ease-in-out 0.2s all;
            transform: translate3d(0, -20%, 0);
        }
        .box-hide {
            visibility: visible;
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
        .show-box {
            padding: 0;
        }
        .message-button .box-close {
            position: absolute;
        }
        .messangers-list-container {
            overflow: hidden;
        }
        .messangers-list {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
            transition: transform 0.4s;
            transition-timing-function: cubic-bezier(0.7, 0, 0.3, 1);
            padding-left: 0 !important;
        }
        .box-icon-chat .messangers-list {
            transition: transform 0s 0.2s;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0);
        }
        .box-icon-chat .messangers-list li {
            transition: transform 0s 0.2s;
            transition-timing-function: cubic-bezier(0.3, 0, 0.3, 1);
            transform: translate3d(0, 500px, 0);
        }
        .box-icon-chat.box-hide ul {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
            transition: transform 0.4s;
            transition-timing-function: cubic-bezier(0.7, 0, 0.3, 1);
        }
        .box-icon-chat.box-hide li {
            transition: transform 0.4s;
            transition-timing-function: cubic-bezier(0.7, 0, 0.3, 1);
            transition-duration: 0.4s;
            transform: translate3d(0, 0, 0);
        }
        @keyframes ripple-red {
            0% {
                -webkit-box-shadow: 0 0 0 0px rgba(100,100,100, 0.1),
                0 0 0 0 rgba(100,100,100, 0.1);
                box-shadow: 0 0 0 0 rgba(100,100,100, 0.1),
                0 0 0 10px rgba(100,100,100, 0.1), 0 0 0 20px rgba(100,100,100, 0.1);
            }
            100% {
                -webkit-box-shadow: 0 0 0 10px rgba(100,100,100, 0.1),
                0 0 0 15px rgba(100,100,100, 0);
                box-shadow: 0 0 0 10px rgba(100,100,100, 0.1),
                0 0 0 10px rgba(100,100,100, 0.1), 0 0 0 15px rgba(100,100,100, 0);
            }
        }

    </style>
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
