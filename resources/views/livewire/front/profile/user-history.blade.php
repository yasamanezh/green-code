<div>
    <!--profile------------------------------------>
    <div class="container-main">
        <div class="col-12">
            <div class="breadcrumb-container  mt-2">
                <ul class="js-breadcrumb ">
                    <li class="breadcrumb-item">
                        <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('Profile')}}" class="breadcrumb-link">حساب کاربری من</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a class="breadcrumb-link active-breadcrumb">بازدیدهای اخیر</a>
                    </li>
                </ul>
            </div>
        </div>
        @include('livewire.front.profile.sidbar')
        <div class="col-lg-9 col-md-9 col-xs-12 pull-left">
            <section class="page-contents">
                <div class="profile-content">
                    <div class="headline-profile">
                        <span>بازدید های اخیر</span>
                    </div>
                    <div class="profile-stats">
                        <div class="profile-stats-row">
                            <section class="profile-user-history">
                                <ul class="profile-user-history-listing">
                                    @foreach($histories as $history)
                                        @php  $product=\App\Models\Product::find($history->product_id);   @endphp
                                        @if($product)
                                            <li class="profile-user-history-list-item">
                                                <div class="profile-user-history-list-item-thumb">
                                                    <a href="{{route('SingleProduct',$product->slug)}}"
                                                       class="profile-user-history-list-item-img">
                                                        <img src="/storage/{{$product->image}}">
                                                    </a>
                                                </div>
                                                <div class="profile-user-history-list-item-content">
                                                    <div class="profile-user-history-list-item-content-container">
                                                        <a href="{{route('SingleProduct',$product->slug)}}">
                                                            <h4>{{$product->title}}</h4>
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="profile-user-history-list-item-content-container">
                                                    <div class="new-price">
                                                        <div class="new-price-value">
                                                            @if($product->price == 0)
                                                                0 تومان
                                                            @elseif($this->priceProdct($product->id ) ==1)
                                                                <s class=" font-size-12">{{number_format($product->price)}}
                                                                    تومان</s>
                                                                <br>

                                                                <span
                                                                    class="new-price-discount ">%{{(1-$this->priceProdct($product->id ))*100}}</span>
                                                                <span
                                                                    class="font-size-14"> {{number_format($this->priceProdct($product->id )*$product->price)}}</span>
                                                                <span class="toman">تومان</span>
                                                            @else
                                                                <span
                                                                    class="text-center font-size-14">{{number_format($product->price)}} </span>
                                                                <span class="toman">تومان</span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="profile-user-history-list-item-button-group">
                                                        <a href="{{route('SingleProduct',$product->slug)}}"
                                                           class="profile-user-history-list-item-button">مشاهده کالا</a>
                                                        <a wire:click.prevent="deleteUserHistory({{$history->id}})"
                                                           class="profile-user-history-list-item-delete-button">
                                                            <span class="fa fa-trash"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
            <div class="position-relative pull-left">{{$histories->links()}}</div>

        </div>

    </div>
    <!--    product-slider----------------------------------->
</div>
