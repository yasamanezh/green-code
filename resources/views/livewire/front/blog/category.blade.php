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
                                <li class="breadcrumb-item text-white active" aria-current="page">وبلاگ</li>
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
                    @foreach($Posts as $post)
                        <div class="col-sm-4 float-right section-style position-relative">
                            <div class="card custom-card text-center">
                                <img class="card-img-top w-100 blog-img" src="/storage/{{$post->image}}" alt="">
                                <div class="card-body" style="height:150px">
                                    <span class=" ">  {!! \Illuminate\Support\Str::limit($post->title,30,'...') !!}</span>
                                    <br>
                                    <br>
                                    <a href="{{route('FrontPost',$post->slug)}}" class="btn ripple btn-outline-danger btn-sm" href="">ادامه مطلب </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        @if($readyToLoad)
                            <div class="section-style position-relative">
                                {{$Posts->links()}}
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>

</div>
