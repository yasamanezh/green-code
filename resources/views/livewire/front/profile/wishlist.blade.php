<div>
    <div class="container-xxl position-relative p-0 mr-3">

        <div class="container-xxl py-5 bread-margin">
            <div class="container my-5 py-5 px-lg-5" style="margin-right: 10%">
                <div class="row g-5 py-5 ">
                    <div class="col-12 text-center">
                        <h1 class="text-white animated zoomIn">حساب کاربری</h1>
                        <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Home')}}">خانه</a></li>
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Profile')}}">حساب کاربری</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">لیست علاقه مندی ها</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl">
        <div class="container px-lg-5">
            <div class="row g-5">
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    @include('livewire.front.profile.sidbar')
                </div>
                <div class="col-lg-9">
                    <section class="page-contents">
                        <div class="profile-content">
                            <div class="headline-profile headline-profile-favorites">
                                <ul class="pager-tabs">
                                    <li class="pager-tab">لیست علاقه‌مندی‌ها</li>
                                </ul>
                            </div>
                            <div class="profile-stats">
                                <div class="profile-stats-row">
                                    <section class="profile-user-history">
                                        <ul class="profile-user-history-listing">
                                            @foreach($wishlists as $list)
                                                @php  $product=\App\Models\Product::find($list->product_id);   @endphp
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
                                                                <a wire:click.prevent="removeToWishlist({{$list->id}})"
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
                    <div class="position-relative pull-left">{{$wishlists->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
