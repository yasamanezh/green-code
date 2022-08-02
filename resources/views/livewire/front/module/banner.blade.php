<aside class="adplacement-container-column @if($banners->style)  {{$banners->style}} @endif">
    <div class="banners">
        <div class="banner adplacement-item adplacement-item-column">
            <div class="adplacement-sponsored-box">
                <a href="{{$banners->link}}" class="">

                    <img class="img-fluid responsive"  @if($banners->height)style="height:{{$banners->height}}px"  @endif src="/storage/{{$banners->img}}" alt="{{$banners->title}}" title="{{$banners->title}}">

                </a>
            </div>
        </div>
    </div>
</aside>



