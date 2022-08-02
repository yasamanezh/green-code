<div class="container-main" wire:init="isReady">
    <div class="col-12">
        <div class="breadcrumb-container mt-2">
            <ul class="js-breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="" class="breadcrumb-link active-breadcrumb">وبلاگ</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="page-content blog-page section-style">
        <div class="container-fluid">
            <div class="">
                <div class="blog ">
                    <livewire:front.blog.sidbar />
                    <!-- Sidebar Ends -->
                    <div class="position-relative bg-white-5" style="width: 100%;height: auto;display: block">
                        <div class="col-xs-12 col-md-9 pull-right">
                            <div class="container-main">

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

                            </div>
                            @if($readyToLoad)
                                <div class="section-style position-relative">
                                    {{$Posts->links()}}
                                </div>
                            @endif
                        </div>
                    </div>
                    </section>
                </div>
            </div>


        </div>
    </div>
    <!--cart--------------------------------------->

</div>
