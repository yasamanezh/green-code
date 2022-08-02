<div>
    @if($options->icon)
        <link rel="icon" href="{{asset("storage/$options->icon")}}" type="image/x-icon"/>
    @endif
<!--    main style------------------------------>
    @stack('moduleCss')
    @if($options->header_code)
        {{$options->header_code}}
    @endif
    @if($options->custome_css)
        <style>
            {{$options->custome_css}}
        </style>
    @endif
    <livewire:styles/>
</div>
