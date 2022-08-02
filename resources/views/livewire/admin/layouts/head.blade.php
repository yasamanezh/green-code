<div>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title>@yield('title')</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- Bootstrap css-->
    <link href="{{asset('admin/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!-- Icons css-->
    <link href="{{asset('admin/plugins/web-fonts/icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('admin/plugins/web-fonts/font-awesome/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/web-fonts/plugin.css')}}" rel="stylesheet"/>

    <!-- Style css-->
    <link href="{{asset('admin/css-rtl/style/style.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css-rtl/skins.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css-rtl/dark-style.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css-rtl/colors/default.css')}}" rel="stylesheet">

    <!-- Color css-->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('admin/css-rtl/colors/color.css')}}">

    <!-- Select2 css -->
    {{--  <link href="{{asset('admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
      <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>--}}
    <!-- Internal Quill css-->
    <link href="{{asset('admin/plugins/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/quill/quill.bubble.css')}}" rel="stylesheet">


    <!-- Internal Inputtags css-->
    <link href="{{asset('admin/plugins/inputtags/inputtags.css')}}" rel="stylesheet">

    <!-- Internal Prism css-->
    <link href="{{asset('admin/plugins/prism/prism.css')}}" rel="stylesheet">

    <!-- InternalFileupload css-->
    <link href="{{asset('admin/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

    <!-- InternalFancy uploader css-->
    <link href="{{asset('admin/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />

    <!-- InternalSumoselect css-->
    <link rel="stylesheet" href="{{asset('admin/plugins/sumoselect/sumoselect-rtl.css')}}">
    <style>
        .overflow-x-hidden{
            overflow-x: hidden !important;
        }
    </style>

    <!-- Sidemenu css-->
    <link href="{{asset('admin/css-rtl/sidemenu/sidemenu.css')}}" rel="stylesheet">
    <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>

    <!-- custom css-->
    @stack('customcss')

    <livewire:styles/>
    <!-- Scripts -->
    <script src="{{asset('js/app.js')}}" defer></script>
</div>
