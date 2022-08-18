<div>

    <div class="sidebar1">
        <!-- Categories Widget Starts -->
        <div class="widget float-right">
            <h3 class="widget-title">دسته بندی ها</h3>
            @foreach($oneLevelBlogs as $cattwo)
                @if($this->hasParent($cattwo->id))
                    <div >
                        <div class="box-header">
                            <h2 class="mb-0">
                                <button class="btn btn-block text-right" data-toggle="collapse" href="#collapseExample{{$cattwo->id}}" role="button" aria-expanded="true" aria-controls="collapseExample">
                                    {{$cattwo->title}}
                                    <i class="mdi mdi-chevron-down float-left"></i>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseExample{{$cattwo->id}}" class="collapse" style="">
                            <div class="card-main mb-3">
                                @foreach(\App\Models\Blog::where('status',1)->where('parent',$cattwo->id)->get() as $value)

                                    <div class="form-auth-row">
                                        <a href="{{route('BlogCategory',$value->slug)}}"  class="remember-me">{{$value->title}}</a>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>

                @endif
            @endforeach
            @foreach($oneLevelBlogs as $cat)
                @if(! $this->hasParent($cat->id))
                    <div >
                        <div class="box-header">
                            <h2 class="mb-0">
                                <a class="btn btn-block text-right post-tag-a"  href="{{route('BlogCategory',$cat->slug)}}">
                                    {{$cat->title}}
                                </a>
                            </h2>
                        </div>

                    </div>

                @endif
            @endforeach


        </div>

        <div class="widget recent-posts float-right">
            <h3 class="widget-title">جدیدترین مطالب</h3>
            <ul class="unstyled clearfix">
                <!-- Recent Post Widget Starts -->
                @foreach($NewPosts as $NewPost)
                    <li>
                        <div class="posts-thumb pull-left">
                            <a href="{{route('FrontPost',$NewPost->slug)}}">
                                <img alt="img" src="/storage/{{$NewPost->image}}" title="{{$NewPost->title}}">
                            </a>
                        </div>
                        <div class="post-info">
                            <h4 class="entry-title">
                                <a href="{{route('FrontPost',$NewPost->slug)}}">{{$NewPost->title}}</a>
                            </h4>
                            <p class="post-meta">

                                <span class="post-date"><i class="fa fa-clock-o"></i> {{ verta($NewPost->created_at)->format('%d/ %B  / %Y') }} </span>
                            </p>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <!-- Recent Post Widget Ends -->

                @endforeach
            </ul>
        </div>
        <!-- Latest Posts Widget Ends -->
    </div>
</div>
