<div>
    <div class="col-lg-4 col-xs-12 pb-5 pull-right">
    <ul class="gallery-options">
        <li>
            @if(auth()->user())
                @if($likes)
                    @if($likes->like==1)
                        <div class="btn-group options-item add-compare">
                            <span class="tooltip-option">علاقه مندی ها</span>
                            <div class="" style="cursor: pointer"
                                 wire:click="removeToWishlist({{$product->id}})">
                                <svg class="icon icon-like" height="24" viewBox="0 0 24 24" width="24"
                                     xmlns="http://www.w3.org/2000/svg"
                                     class="formcontact">
                                    <path
                                        d="m9.15 13.5c-.63333333.6666667-1.66666667.6666667-2.3 0-1.93333333-2.0333333-3.93333333-4.23333333-5.6-5.93333333s-1.66666667-4.53333334 0-6.26666667c.8-.83333333 1.86666667-1.3 3-1.3s2.2.43333333 3 1.3l.33333333.4c.2.26666667.63333334.26666667.86666667 0l.26666667-.33333333.03333333-.03333334c.83333333-.86666666 1.9-1.33333333 3-1.33333333 1.1333333 0 2.2.43333333 3 1.3 1.6666667 1.7 1.6666667 4.53333333 0 6.26666667-1.6666667 1.73333333-3.6333333 3.90000003-5.6 5.93333333z"
                                        fill="red" stroke="red" stroke-width="2"
                                        transform="translate(4 5)"></path>
                                </svg>

                            </div>
                        </div>
                    @endif
                @else
                    <div class="btn-group options-item add-compare ">
                        <span class="tooltip-option">علاقه مندی ها</span>
                        <div class="" wire:click="addToWishlist({{$product->id}})" style="cursor: pointer">
                            <svg class="icon icon-like" height="24" viewBox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg"
                                 class="formcontact">
                                <path
                                    d="m9.15 13.5c-.63333333.6666667-1.66666667.6666667-2.3 0-1.93333333-2.0333333-3.93333333-4.23333333-5.6-5.93333333s-1.66666667-4.53333334 0-6.26666667c.8-.83333333 1.86666667-1.3 3-1.3s2.2.43333333 3 1.3l.33333333.4c.2.26666667.63333334.26666667.86666667 0l.26666667-.33333333.03333333-.03333334c.83333333-.86666666 1.9-1.33333333 3-1.33333333 1.1333333 0 2.2.43333333 3 1.3 1.6666667 1.7 1.6666667 4.53333333 0 6.26666667-1.6666667 1.73333333-3.6333333 3.90000003-5.6 5.93333333z"
                                    fill="none" stroke="#53688c" stroke-width="2"
                                    transform="translate(4 5)"></path>
                            </svg>

                        </div>
                    </div>
                @endif
            @else
                <div class="btn-group">
                    <a href="{{route('login')}}" class="options-item add-compare ">
                        <span class="tooltip-option">علاقه مندی ها</span>
                        <svg class="icon icon-like" height="24" viewBox="0 0 24 24" width="24"
                             xmlns="http://www.w3.org/2000/svg"
                             class="formcontact">
                            <path
                                d="m9.15 13.5c-.63333333.6666667-1.66666667.6666667-2.3 0-1.93333333-2.0333333-3.93333333-4.23333333-5.6-5.93333333s-1.66666667-4.53333334 0-6.26666667c.8-.83333333 1.86666667-1.3 3-1.3s2.2.43333333 3 1.3l.33333333.4c.2.26666667.63333334.26666667.86666667 0l.26666667-.33333333.03333333-.03333334c.83333333-.86666666 1.9-1.33333333 3-1.33333333 1.1333333 0 2.2.43333333 3 1.3 1.6666667 1.7 1.6666667 4.53333333 0 6.26666667-1.6666667 1.73333333-3.6333333 3.90000003-5.6 5.93333333z"
                                fill="none" stroke="#53688c" stroke-width="2"
                                transform="translate(4 5)"></path>
                        </svg>

                    </a>
                </div>
            @endif
        </li>
        <li>
            <a wire:click.prevent="compare()" class="options-item add-compare"><i
                    class="mdi mdi-compare"></i></a>
            <span class="tooltip-option">مقایسه</span>
        </li>
    </ul>
        @if($this->is_special($product->id))
        <div class="product-timeout position-relative pt-2">
            <div class="promotion-badge">
                فروش ویژه
            </div>
            <div class="countdown countdown-style-3 h4" data-date-time="{{$this->is_special($product->id)}}"
                 data-labels='{"label-day": "روز","label-second": "ثانیه","label-minute": "دقیقه", "label-hour": "ساعت"}'>
            </div>
        </div>
        @endif

        <div class="product-gallery" wire:ignore>
        <div  class="product-gallery-carousel owl-carousel">
            <div class="item" wire:ignore.self>
                <a class="gallery-item" href="/storage/{{$product->image}}"
                   data-fancybox="gallery1" data-hash="one">
                    <img src="/storage/{{$product->image}}" alt="Product">
                </a>
            </div>
            @foreach($product->productImages as $value)
                <div class="item" wire:ignore.self>
                    <a class="gallery-item" href="/storage/{{$value->img}}"
                       data-fancybox="gallery1" data-hash="image{{$value->id}}">
                        <img src="/storage/{{$value->img}}" alt="{{$product->title}}">
                    </a>
                </div>
            @endforeach
        </div>
        <ul class="product-thumbnails">
            <li class="active">
                <a wire:ignore href="#one">
                    <img src="/storage/{{$product->image}}" alt="Product">
                </a>
            </li>
            @foreach($product->productImages as $value)
                <li>
                    <a wire:ignore href="#image{{$value->id}}">
                        <img src="/storage/{{$value->img}}" alt="{{$product->title}}">
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
    </div>
</div>
