<div>
    @if($options->ads_status && $options->ads_img )
        <aside class="adplacement-top-header">
            <a href="{{$options->ads_link}}" class="adplacement-item"  style=" background: url(/storage/{{$options->ads_img}});">
            </a>
        </aside>
    @endif
</div>
