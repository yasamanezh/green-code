<div>
    <div class="card">
    <div class="comments ">

        <div class="comments-summary">
            <div class="comments-summary-box">
                <ul class="comments-item-rating">
                    <li>
                        ثبت نظر:
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
                                 wire:click.prevent="Add()" style="width: 50%">
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
        </div>
    </div>
    @foreach($comments as $comment)
        <section class="comment-body box-body  ">
            <div class="col-xs-12 col-lg-12 pull-right">
                <div class="aside card-header">
                    <ul class="comments-user-shopping pt-1">
                        <li class="mb-3">
                            <div class="cell cell-name">
                                @if(\App\Models\User::where('id',$comment->user_id)->first())
                                    {{\App\Models\User::where('id',$comment->user_id)->pluck('name')->first()}}
                                @endif
                            </div>

                        </li>
                        <li class="mb-3">
                            <div class="cell cell-name pull-left" style="margin-top: -30px"
                                 wire:click.prevent="is_buyyer({{$comment->user_id}})">
                                {{ verta($comment->created_at)->format('%d %B  %Y') }}
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 pull-left">
                <div class="article card-body">
                    <div class="header">
                        <div>{{$comment->title}}</div>
                    </div>
                    <p>

                        {{$comment->content}}
                    </p>
                    @if($this->is_buyyer($comment->user_id) == true)
                        <div class="comments-buyer-badge"><span
                                class="mdi mdi-cart"></span>خریدار محصول
                        </div>
                    @endif
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
        </section><br>
    @endforeach
    <div class="position-relative pull-left">{{$comments->links()}}</div>
</div>
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
