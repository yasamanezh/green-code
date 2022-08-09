<div  wire:init="isReady">
    <div class="container-xxl position-relative p-0" style="margin-top: -400px">

        <div class="container-xxl py-5 bg-primary hero-header mb-5">
            <div class="container my-5 py-2 px-lg-5">
                <div class="row g-5 py-2">
                    <div class="col-lg-6 text-center text-lg-start">
                        <img class="img-fluid" src="http://green-code.test/storage/photos/2/hero.png" alt="">
                    </div>

                    <div class="col-lg-6 text-center text-lg-start  mt-5" style="margin-top: 150px !important;">
                        <h1 class="text-white animated zoomIn text-center ">وبلاگ</h1>
                        <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Home')}}">خانه</a></li>
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('FrontBlog')}}">وبلاگ</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">{{$post->title}}</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">

                <div class="col-lg-3">
                    <livewire:front.blog.sidbar />
                </div>
                <div class="col-lg-9">
                    <div class="blog-post-area listing padding-20">
                        <div class="single-blog-post">
                            <h1 class="mb-2">{{$post->title}}</h1>

                            <a href="">
                                <img src="/storage/{{$post->image}}" alt="{{$post->title}}">
                            </a>
                            <br>
                            {!! $post->description !!}
                        </div>
                    </div>
                    <livewire:front.blog.comment :id="$post->id" />
                </div>
            </div>
        </div>
    </div>

</div>
