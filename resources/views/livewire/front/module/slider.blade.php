<div class="main-slider-container">
    <div id="carouselExampleIndicators{{$idModule}}" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @for($i=0;$i<=$count-1;$i++)
                <li data-target="#carouselExampleIndicators{{$idModule}}" data-slide-to="{{$i}}" @if($i==0) class="active" @endif></li>
            @endfor
        </ol>
        <div class="carousel-inner">
            @foreach($slider->Slides as $ke=>$value)
            <div class="carousel-item @if($loop->first) active @endif">

                <img class="d-block w-100 img-fluid"  src="/storage/{{$value->img}}" alt="{{$value->title}}">

            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators{{$idModule}}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators{{$idModule}}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
