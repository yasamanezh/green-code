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
                            <h1>{{$post->title}}</h1>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <!-- section begin -->
        <section aria-label="section">
            <div class="container">
                <div class="row">
                    <div id="sidebar" class="col-md-4">
                        <div class="widget rtl-dir">
                            <h4> اشتراک گذاری با دوستان:</h4>
                            <div class="small-border"></div>
                            <div class="de-color-icons">
                                <span><i class="fa fa-twitter fa-lg"></i></span>
                                <span><i class="fa fa-facebook fa-lg"></i></span>
                                <span><i class="fa fa-reddit fa-lg"></i></span>
                                <span><i class="fa fa-linkedin fa-lg"></i></span>
                                <span><i class="fa fa-pinterest fa-lg"></i></span>
                                <span><i class="fa fa-stumbleupon fa-lg"></i></span>
                                <span><i class="fa fa-delicious fa-lg"></i></span>
                                <span><i class="fa fa-envelope fa-lg"></i></span>
                            </div>
                        </div>

                        <div class="widget widget-post rtl-dir">
                            <h4>آخرین مقالات:</h4>
                            <div class="small-border"></div>
                            <ul>
                                @foreach($latests as $item)
                                <li><span class="date">{{ verta($item->created_at)->format('%d %B  ') }}</span><a href="#">{{$item->title}}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        @if($post->meta_keyword)

                        <div class="widget widget_tags rtl-dir" >
                            <h4>تگ ها:</h4>
                            <div class="small-border"></div>
                            <ul>
                                @foreach(explode(',',$post->meta_keyword) as $meta)
                                <li><a href="#link">{{$meta}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div>
                    <div class="col-md-8">
                        <div class="blog-read">

                            <img alt="{{$post->title}}" src="/storage/{{$post->image}}" class="img-fullwidth mb30"
                                 style="width: 736px;height: 490px">

                            <div class="post-text">

                            </div>

                        </div>

                        <div class="spacer-single"></div>



                    </div>
                    <div class="col-md-12  rtl-dir">
                        <div class="post-p" >
                            {!! $post->description !!}
                        </div>

                    </div>

                    <div class="col-4"></div>
                    <div class="col-8">
                        <div id="blog-comment " class="rtl-dir">
                            <div class="spacer-half"></div>

                            <ol>
                                @foreach($comments as $comment)
                                    <li>
                                        <div class="avatar">
                                            <img src="{{asset('images/misc/avatar-2.jpg')}}" alt="طراحی سایت اختصاصی" /></div>
                                        <div class="comment-info">
                                            <span class="c_name">کاربر سایت</span>
                                            <span class="c_date id-color"> {{ verta($comment->created_at)->format('%d/ %B  / %Y') }}</span>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="comment">
                                            {{$comment->content}}
                                        </div>
                                        @if($comment->answer)
                                            <ol>
                                                <li>
                                                    <div class="avatar">
                                                        <img src="{{asset('images/misc/avatar-2.jpg')}}" alt="طراحی سایت اختصاصی" /></div>
                                                    <div class="comment-info">
                                                        <span class="c_name">ادمین سایت</span>
                                                        <span class="c_date id-color">{{ verta($comment->updated_at)->format('%d/ %B  / %Y') }}</span>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="comment">
                                                        {{$comment->answer}}</div>
                                                </li>
                                            </ol>
                                        @endif
                                    </li>
                                @endforeach

                            </ol>
                            {{$comments->links()}}

                            <div class="spacer-single"></div>

                            <div id="comment-form-wrapper">
                                <h4>ارسال دیدگاه:</h4>
                                @if($isSavComment)
                                    <p class="success">دیدگاه شما ثبت شد و پس از تایید نمایش داده خواهد شد.</p>
                                @endif
                                <div class="comment_form_holder">
                                    <div id="contact_form"  class="form-border">

                                        <label>پیام <span class="req">*</span></label>
                                        <textarea wire:model.defer="comment"  cols="10" rows="10" name="message" id="message" class="form-control"></textarea>
                                        @error('comment')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <br>
                                        <p id="btnsubmit" wire:click.prevent="saveComment()">
                                            <input type="submit" id="send" value="ثبت دیدگاه" class="btn-main" />
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- content close -->
</div>
