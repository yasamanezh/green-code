<div>

    <div class="container-xxl">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">

                <div class="col-lg-12">
                    <!-- blog Start -->
                    <div class="container-xxl " style="direction: ltr">
                        <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                            <h6 class="position-relative d-inline text-primary ps-4">
                                <span class="mr-2">وبلاگ</span>
                            </h6>
                            <h2 class="mt-2">آخرین مقالات وبلاگ</h2>
                        </div>
                        <div class="row rtl">
                        <div class="col-sm-3">
                            @if($posts)
                                @foreach($posts as $post)
                                    <div class="box ">
                                        <div class="item blog-module-item">
                                            <a href="{{route('FrontPost',$post->slug)}}" >
                                                <img  src="/storage/{{$post->thumbnail}}"  class="img-fluid" alt="{{$post->title}}" title="{{$post->title}}">
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
        </div>
    </div>
</div>

