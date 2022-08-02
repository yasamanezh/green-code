<div>
    <section wire:ignore.self class="tab-content-wrapper position-relative">
        <div class="comments">
            <h2 class="comments-headline">امتیاز کاربران به:
                <span> {{$product->title}}  </span>
            </h2>
            <div class="comments-summary">
                <div class="comments-summary-box">
                    <ul class="comments-item-rating">
                        <li>
                            <div class="cell">امتیاز:</div>
                            <div class="cell">
                                <div class="rating-general" data-rate-digit="{{$this->is_good()}}">
                                    <div class="rating-rate"
                                         style="width:{{$this->calculateRate()}}%;"></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="comments-summary-note">
                        <p>
                            @if(! auth())

                                برای ثبت نظر، لازم است ابتدا<a href="{{route('login')}}">وارد حساب کاربری</a>
                                خود شوید.
                            @endif
                            اگر این محصول را قبلا از ما خریده باشید،
                            نظر
                            شما به عنوان مالک محصول ثبت خواهد شد.
                        </p>
                        <div class="parent-btn lr-ds">
                            @if(auth()->user())
                            <button wire:ignore class="dk-btn dk-btn-info"
                                     wire:click.prevent="Add()">
                                افزودن نظر جدید
                                <i class="mdi mdi-comment-text-multiple-outline"></i>
                            </button>
                            @else
                                <p class="font-size-12">
                                    لطفا برای ثبت نظر
                                    <a class="text-danger" href="/login">وارد شوید.</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm hidden-md" style="float: left; width: 50%;">
                    <img class="rating-img img-fluid" src="{{asset('assets/images/rating.jpg')}}">
                </div>
            </div>
        </div>
        @foreach($comments as $comment)
            <section class="comment-body ">
                <div class="col-lg-4 col-md-4 col-xs-12 pull-right">
                    <div class="aside">
                        <ul class="comments-user-shopping pt-1">
                            <li class="mb-3">
                                <div class="cell cell-name">
                                    @if(\App\Models\User::where('id',$comment->user_id)->first())
                                        {{\App\Models\User::where('id',$comment->user_id)->pluck('name')->first()}}
                                    @endif
                                </div>
                                @if($this->is_buyyer($comment->user_id) == true)
                                    <div class="comments-buyer-badge"><span
                                            class="mdi mdi-cart"></span>خریدار محصول
                                    </div>
                                @endif
                            </li>
                            <li>
                                <div class="cell"
                                     wire:click.prevent="is_buyyer({{$comment->user_id}})">
                                    {{ verta($comment->created_at)->format('%d %B  %Y') }}
                                </div>
                            </li>
                        </ul>
                        @if($comment->is_advice ==1)
                            <div class="message-light-opinion-positive"><span
                                    class="fa fa-thumbs-o-up"></span>خرید این
                                محصول را توصیه می‌کنم
                            </div>
                        @else
                            <div class="message-light-opinion-negetive"><span
                                    class="fa fa-thumbs-o-down"></span>خرید این
                                محصول را توصیه نمیکم
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-xs-12 pull-left">
                    <div class="article">
                        <div class="header">
                            <div>{{$comment->title}}</div>
                        </div>
                        <p>
                            {{$comment->content}}
                        </p>
                        <div class="comments-evaluation">
                            <div class="comments-evaluation-positive">
                                <span>نقاط قوت</span>
                                <ul>
                                    @foreach(explode(',',$comment->positives) as $positiveValues )
                                        <li>
                                            {{$positiveValues}}
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="comments-evaluation-negative">
                                <span>نقاط ضعف</span>
                                <ul>
                                    @foreach(explode(',',$comment->negetives) as $negetiveValues)
                                        <li>
                                            {{$negetiveValues}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="footer">
                            <div class="comments-likes">آیا این نظر برایتان مفید بود؟
                                <button class="btn-like js-comment-like"
                                        wire:click.prevent="addUseful({{$comment->id}})"
                                        data-counter="{{$this->counUsefullComment($comment->id)}}">
                                    بله
                                </button>
                                <button class="btn-like js-comment-dislike"
                                        wire:click.prevent="addUNoseful({{$comment->id}})"
                                        data-counter="{{$this->counNoUsefullComment($comment->id)}}">
                                    خیر
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section><br>
        @endforeach
        <div class="position-relative pull-left">{{$comments->links()}}</div>
    </section>
    @push('jsBeforMain')
        <script>
            $(document).ready(function () {

                window.addEventListener('show-form', event => {
                    $('#form').modal('show');
                })

            });

        </script>


    @endpush
</div>
