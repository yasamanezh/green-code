<div>
    <!-- content begin -->
    <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section id="subheader" class="jarallax">
            <img src="{{asset('images/background/subheader.jpg')}}" class="jarallax-img" alt="طراحی سایت اختصاصی">
            <div class="center-y relative text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>اخبار و مقالات</h1>
                        </div>
                        <div class="col-md-6 offset-md-3">
                            <p class="lead">
                                اخرین اخبار و مقالات
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->
        <section id="section-hero" class="no-top mt-50" aria-label="section">
            <div class="container">
                <div class="row">
                    @foreach($Posts as $post)
                    <div class="col-lg-4 col-md-6 mb10">
                        <div class="bloglist item">
                            <div class="post-content">
                                <div class="post-image">
                                    <img alt="{{$post->title}}" src="/storage/{{$post->image}}" class="lazy" width="356" height="237" >
                                </div>
                                <div class="post-text rtl-dir">
                                     <h1><a href="{{route('SingleBlogFront',$post->slug)}}">{{$post->title}}</a></h1>
                                    {!! \Illuminate\Support\Str::limit($post->description,130,'...') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="spacer-single"></div>
                    <div class="col-md-12">
                        {{$Posts->links()}}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
</div>
