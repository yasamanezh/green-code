<div>
    <!--start modal --->
    <div class="modal" wire:ignore.self id="form"
         style="display: none; padding-right: 17px;" aria-modal="true">
        <div class="modal-dialog" style="max-width: 700px !important;"
             role="document">
            <div class="modal-content modal-content-demo " style="border-radius:5px">
                <div class="modal-header border-bottom-0">
                    <h6 class="modal-title">افزودن نظر</h6>
                    <button aria-label="بستن" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">×</span></button>
                </div>
                <hr>
                <div class="modal-body" style="padding: 0 !important;">
                    <!--product-comment---------------------------->
                    <div class="container-main">
                        <div class="col-12">
                            <form action="#" id="addCommentForm">
                                <section class="product-comment">
                                    <div class="comments-product">
                                        <div class="comments-product-row">

                                            <div class="comments-add">
                                                <div class="comments-add-row">
                                                    <div
                                                        class="col-lg-6 col-md-6 col-xs-12 pull-right">
                                                        <div
                                                            class="comments-add-col-form">
                                                            <div
                                                                class="form-comment">
                                                                <div class="col-md-12 col-sm-12">
                                                                    <div class="form-ui">
                                                                        <form class="px-5">
                                                                            <div class="row">
                                                                                <div class="col-12 flex">
                                                                                    <span>امتیاز :</span><br><br>
                                                                                    <div class="rate">
                                                                                        <input wire:model.defer="rate"
                                                                                               type="radio" id="star5"
                                                                                               name="rate" value="5"/>
                                                                                        <label for="star5" title="text">5
                                                                                            stars</label>
                                                                                        <input wire:model.defer="rate"
                                                                                               type="radio" id="star4"
                                                                                               name="rate" value="4"/>
                                                                                        <label for="star4" title="text">4
                                                                                            stars</label>
                                                                                        <input wire:model.defer="rate"
                                                                                               type="radio" id="star3"
                                                                                               name="rate" value="3"/>
                                                                                        <label for="star3" title="text">3
                                                                                            stars</label>
                                                                                        <input wire:model.defer="rate"
                                                                                               type="radio" id="star2"
                                                                                               name="rate" value="2"/>
                                                                                        <label for="star2" title="text">2
                                                                                            stars</label>
                                                                                        <input wire:model.defer="rate"
                                                                                               type="radio" id="star1"
                                                                                               name="rate" value="1"/>
                                                                                        <label for="star1" title="text">1
                                                                                            star</label>
                                                                                        @error('rate')
                                                                                        <br>
                                                                                        <span
                                                                                            class="is-invalid">{{$message}}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-row-title mb-2">
                                                                                        عنوان نظر شما (اجباری)
                                                                                    </div>

                                                                                    <div class="form-row">
                                                                                        <input wire:model.defer="title"
                                                                                               class="input-ui pr-2"
                                                                                               placeholder="عنوان نظر خود را بنویسید">
                                                                                        @error('title')
                                                                                        <span
                                                                                            class="is-invalid">{{$message}}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 mt-5">
                                                                                    <div class="form-row-title mb-2">
                                                                                        متن نظر شما (اجباری)
                                                                                    </div>
                                                                                    <div class="form-row">
                                                                                        <textarea wire:model.defer="content" class="input-ui pr-2 pt-2"
                                                                                            rows="5"
                                                                                            placeholder="متن خود را بنویسید"
                                                                                            style="height:120px;"></textarea>
                                                                                        @error('content')
                                                                                        <span
                                                                                            class="is-invalid">{{$message}}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <div class="col-12">
                                                                                    <div class="comments-evaluation">
                                                                                        <div class="comments-evaluation-positive">
                                                                                            <span>نقاط قوت: </span><br>
                                                                                            <ul>
                                                                                                @if($positives)
                                                                                                    @foreach($positives as $key => $value)

                                                                                                        <li>
                                                                                                            <i wire:click.prevent="removePositive({{$key}})"
                                                                                                               class="fa fa-minus-circle"
                                                                                                               style="color: red"></i>
                                                                                                            {{$value}}
                                                                                                        </li>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </ul>
                                                                                        </div>

                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-10">
                                                                                    <input wire:model="positive"
                                                                                           class="form-control"
                                                                                           style="margin-top: 16px">
                                                                                    @error('positive')
                                                                                    <span
                                                                                        style="color:red">{{$message}}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <button
                                                                                        wire:click.prevent="AddPositive({{$j}})"
                                                                                        class="btn btn-danger"
                                                                                        style="margin-top: 14px;">
                                                                                        <i class="fa fa-plus-circle"></i>
                                                                                    </button>
                                                                                </div>

                                                                                <br>
                                                                                <div class="col-12">
                                                                                    <div class="comments-evaluation">
                                                                                        <div
                                                                                            class="comments-evaluation-positive">
                                                                                            <span>نقاط ضعف:</span><br>
                                                                                            <ul>
                                                                                                @if($negetives)
                                                                                                    @foreach($negetives as $key=>$negetiveValue)

                                                                                                        <li>
                                                                                                            <i wire:click.prevent="removeNegetives({{$key}})"
                                                                                                               class="fa fa-minus-circle"
                                                                                                               style="color: red"></i>
                                                                                                            {{$negetiveValue}}
                                                                                                        </li>
                                                                                                    @endforeach
                                                                                                @endif

                                                                                            </ul>
                                                                                        </div>

                                                                                    </div>


                                                                                </div>

                                                                                <div class="col-10">
                                                                                    <input wire:model="negetive"
                                                                                           class="form-control"
                                                                                           style="margin-top: 16px">
                                                                                    @error('negetive')
                                                                                    <span
                                                                                        style="color:red">{{$message}}</span>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-2">
                                                                                    <button
                                                                                        wire:click.prevent="AddNegetives({{$j}})"
                                                                                        class="btn btn-danger"
                                                                                        style="margin-top: 14px;">
                                                                                        <i class="fa fa-plus-circle"></i>
                                                                                    </button>
                                                                                </div>

                                                                                <div class="col-12">
                                                                                    <div class="form-auth-row">
                                                                                        <label for="#"
                                                                                               class="ui-checkbox">
                                                                                            <input type="checkbox"
                                                                                                   value="1"
                                                                                                   wire:model.defer="is_advice"
                                                                                                   name="is_advice"
                                                                                                   checked=""
                                                                                                   id="remember">
                                                                                            <span
                                                                                                class="ui-checkbox-check"></span>
                                                                                        </label>

                                                                                        <label for="remember"
                                                                                               class="remember-me">خرید
                                                                                            این محصول را توصیه
                                                                                            میکنید؟</label>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-12 px-0 mt-3">
                                                                                    <button wire:ignore type="submit"
                                                                                            class="btn comment-submit-button"
                                                                                            wire:click.prevent="saveComment({{$product->id}})">
                                                                                        ثبت نظر
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-6 col-md-6 col-xs-12 pull-left">
                                                        <div
                                                            class="comments-add-col-content">
                                                            <h3>دیگران را با نوشتن نظرات خود، برای انتخاب این محصول
                                                                راهنمایی کنید.</h3>
                                                            <div>
                                                                <p>لطفا پیش از ارسال نظر، خلاصه قوانین زیر را مطالعه
                                                                    کنید:</p>
                                                                <p>فارسی بنویسید و از کیبورد فارسی استفاده کنید. بهتر
                                                                    است از فضای
                                                                    خالی (Space) بیش‌از‌حدِ معمول، شکلک یا ایموجی
                                                                    استفاده
                                                                    نکنید و از کشیدن حروف یا کلمات با صفحه‌کلید
                                                                    بپرهیزید.
                                                                </p>
                                                                <p>به کاربران و سایر اشخاص احترام بگذارید.
                                                                    پیام‌هایی که شامل محتوای توهین‌آمیز و
                                                                    کلمات نامناسب باشند، حذف می‌شوند.
                                                                </p>
                                                                @if($siteOption->email || $siteOption->email)
                                                                    <p>هرگونه نقد و نظردر خصوص سایت
                                                                        {{$siteOption->name ? $siteOption->name : 'ما' }}
                                                                        ، خدمات و درخواست کالا را با
                                                                        @if($siteOption->email)ایمیل
                                                                        <a href="mailto:{{$siteOption->email}}">
                                                                            {{$siteOption->email}}
                                                                        </a>
                                                                        @if($siteOption->telephone)
                                                                            یا با شماره‌ی
                                                                            <a href="tel: {{$siteOption->telephone}}">
                                                                                {{$siteOption->telephone}}
                                                                            </a>
                                                                        @endif
                                                                        @else
                                                                            شماره
                                                                            <a href="tel: {{$siteOption->telephone}}">
                                                                                {{$siteOption->telephone}}
                                                                            </a>
                                                                        @endif
                                                                        در میان بگذارید و از نوشتن آن‌ها در بخش نظرات
                                                                        خودداری کنید.
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                    <!--product-comment---------------------------->
                </div>
            </div>
        </div>
    </div>
    <!----end modal-->
    @push('jsBeforMain')
        <script>
            $(document).ready(function () {
                window.addEventListener('hide-form', event => {
                    $('#form').modal('hide');
                })
                 window.addEventListener('show-form', event => {
                    $('#form').modal('show');
                })


            });

        </script>


    @endpush
</div>
