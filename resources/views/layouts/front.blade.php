<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>گرین کد</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- CSS Files
   ================================================== -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap"/>
    <link href="css/mdb.min.css" rel="stylesheet" type="text/css" id="mdb" />
    <link href="css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/coloring.css" rel="stylesheet" type="text/css" />
    <!-- color scheme -->
    <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
<!--@vite(['resources/css/app.css', 'resources/js/app.js']) -->

<!-- Styles -->
    @livewireStyles
</head>
<body>
<div id="wrapper">
    <!-- page preloader begin -->
    <div id="de-loader"></div>
    <!-- page preloader close -->
    <!-- header begin -->
    <livewire:front.layouts.header/>
    <!-- header close -->
    <!-- content begin -->
    <main>
        {{ $slot }}
    </main>
    <!-- content close -->
    <a href="#" id="back-to-top"></a>
    <!-- footer begin -->
    <livewire:front.layouts.footer/>

    <!-- footer close -->
</div>
<!-- Javascript Files
  ================================================== -->
<script src="js/plugins.js"></script>
<script src="js/designesia.js"></script>
@livewireScripts
</body>
</html>
