<div>
    <section class="tab-content-wrapper  position-relative" wire:ignore.self style="display:block;">
        <article>
            <h2 class="params-headline">
                نقد و بررسی
                <span>{{$product->title}}</span>
            </h2>
            <section class="content-expert-summary">
                <div class="mask pm-3">
                    <div class="mask-text">

                        {!! $product->description !!}
                    </div>
                    <a href="#" class="mask-handler">
                        <span class="show-more" style="display: none;">- بستن</span>
                        <span class="show-less" style="display: inline;">+ ادامه مطلب</span>

                    </a>
                    <div class="shadow-box" style="display: inline;"></div>
                </div>
            </section>
            @if($product->naghd)
            <div class="content-short-review">
                <h2 class="params-headline">
                    نقد و بررسی تخصصی
                </h2>
                {!! $product->naghd !!}
            </div>
            <div class="content-expert-articles">
                @foreach($product->productNaghds as $value)
                    <section class="content-expert-article">
                        <button class="content-expert-button">
                            <span class="show-more"><i class="fa fa-plus"></i></span>
                            <span class="show-less"><i class="fa fa-minus"></i></span>
                        </button>
                        <h3 class="content-expert-title">{{$value->title}}</h3>
                        <div class="content-expert-text">
                            <p style="text-align:right">{{$value->description}}</p>

                        </div>
                    </section>
                @endforeach
            </div>
            @endif
        </article>
    </section>
</div>
