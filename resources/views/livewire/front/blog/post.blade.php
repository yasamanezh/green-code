<div wire:init="isReady">
    <div class="page-content blog-page section-style">
        <div class="container-fluid">
            <div class="container-main">
                <div class="col-12">
                    <div class="breadcrumb-container mt-2">
                        <ul class="js-breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('FrontBlog')}}" class="breadcrumb-link">وبلاگ</a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="" class="breadcrumb-link active-breadcrumb">{{$post->title}}</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="blog ">
                    <livewire:front.blog.sidbar />
                    <!-- Sidebar Ends -->
                    <div class="position-relative " style="width: 100%;height: auto;display: block">
                        <div class="col-xs-12 col-md-9 pull-right">
                            <div class="container-main">

                                <div class="col-sm-12 float-right">
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
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!--cart--------------------------------------->
</div>
