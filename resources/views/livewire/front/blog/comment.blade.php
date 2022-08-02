<div>
    <div class="blog-post-area listing padding-20 mt-3">
        <div class="response-area">
            <h2>دیدگاه کاربران</h2>
            @if($isSavComment)
                <p class="text-danger">دیدگاه شما ثبت شد و پس از تایید نمایش داده خواهد شد.</p>
            @endif
            <div class="mt-4 position-relative section-style" wire:ignore.self>
                 <textarea rows="5" class="form-control" wire:model.defer="comment" placeholder="متن دیدگاه"></textarea>
                @error('comment')
                <span class="is-invalid">{{$message}}</span>
                @enderror
                <div class="col-12">
                    <div class="form-group mt-4 mb-4">
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                            <button wire:click.prevent="reloadCaptcha()" type="button" class="btn btn-danger" class="reload" id="reload">
                                &#x21bb;
                            </button>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <input id="captcha" type="text" class="form-control" placeholder="کد امنیتی را وارد کنید." name="captcha" wire:model.defer="captcha">
                    </div>
                    @error('captcha')
                    <span class="is-invalid">{{$message}}</span>
                    @enderror
                </div>

                <div class="parent-btn lr-ds col-sm-4">
                    <button wire:click.prevent="saveComment()" class="dk-btn dk-btn-info " data-target="#modal-datepicker" data-toggle="modal">
                        افزودن نظر جدید
                        <i class="mdi mdi-comment-text-multiple-outline"></i>
                    </button>
                </div>

            </div>
            <ul class="media-list position-relative section-style border-top" >

                @foreach($comments as $comment)
                    <div id="product-questions-list">
                        <div class="questions-list">
                            <ul class="faq-list">
                                <li class="is-question">
                                    <div class="section">
                                        <div class="faq-header">

                                            <span class="icon-faq">?
                                            </span>
                                        </div>
                                        <p>
                                            پرسش:
                                            {{$comment->content}}</p>

                                        <div class="faq-date">
                                            <em> {{ verta($comment->created_at)->format('%d/ %B  / %Y') }}</em>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                        @if($comment->answer)
                            <div class="questions-list answer-questions">
                                <ul class="faq-list">
                                    <li class="is-question">
                                        <div class="section">
                                            <div class="faq-header">
                                                <span class="icon-faq"><i class="mdi mdi-storefront"></i></span>

                                            </div>
                                            <p>
                                                پاسخ  :
                                                {{$comment->answer}}</p>
                                            <div class="faq-date">
                                                <em>{{ verta($comment->updated_at)->format('%d/ %B  / %Y') }}</em>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endif

                    </div>
                @endforeach
            </ul>

            <div class="section-style position-relative">
                {{$comments->links()}}
            </div>
        </div>


        <br>

    </div>
</div>
