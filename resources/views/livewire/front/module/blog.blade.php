<div class="section-slider-product posts-module">
    <div class="widget widget-product card">
        <header class="card-header">
            <span class="title-one">آخرین مطالب وبلاگ</span>
            <h3 style="height: 40px"></h3>
        </header>

        <div  class="product-carousel owl-carousel owl-theme owl-rtl owl-loaded owl-drag" id="carousel-bog">
            <div class="owl-stage-outer">
                <div class="owl-stage blog" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 2234px;">
                    @if($posts)
                        @foreach($posts as $post)
                            <div class="owl-item " style="width: 309.083px; margin-left: 10px;">
                                <div class="item blog-module-item">
                                    <a href="{{route('FrontPost',$post->slug)}}" >
                                        <img class="blog-module-img" src="/storage/{{$post->thumbnail}}"  class="img-fluid" alt="{{$post->title}}" title="{{$post->title}}">
                                        {!! \Illuminate\Support\Str::limit($post->description,40,'...') !!}
                                        </a>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

