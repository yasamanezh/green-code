<div>
    <div class="container-xxl position-relative p-0 mr-3">

        <div class="container-xxl py-5 bread-margin">
            <div class="container-fluid my-5 py-5 px-lg-5" style="margin-right: 10%">
                <div class="row g-5 py-5 ">
                    <div class="col-12 text-center">
                        <h1 class="text-white animated zoomIn">حساب کاربری</h1>
                        <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Home')}}">خانه</a></li>
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Profile')}}">حساب کاربری</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">دانلودها</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                    @include('livewire.front.profile.sidbar')
                </div>
                <div class="col-lg-9">
                    <section class="page-contents">
                        <div class="col-xs-12">
                            <div class="profile-stats profile-order">
                                <div class="profile-order-steps-note">
                                    <h4>سفارش {{$order->order_number}}</h4>

                                </div>

                                <div class="table-orders table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">نام محصول</th>
                                            <th scope="col">قیمت </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>
                                                    <h3>{{$this->title($order->id)}}</h3>

                                                    @foreach($order->products as $product)
                                                        {{$product->option}} :   {{$product->title}}<br>
                                                    @endforeach
                                                </td>
                                                <td>{{number_format($order->product_price)}} تومان</td>
                                            </tr>

                                        <tr>
                                            <td  class="text-right">جمع جزء:</td>
                                            <td class="text-right">{{number_format($order->product_price)}} تومان</td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">تخفیف بر روی صورتحساب:</td>
                                            <td class="text-right">{{number_format($order->cart_discount_price)}} تومان</td>
                                        </tr>
                                        <tr>
                                            <td  class="text-right">کوپن تخفیف:</td>
                                            <td class="text-right">{{number_format($order->copen_price)}} تومان</td>
                                        </tr>
                                            <tr>
                                                <td  class="text-right">لینک دانلود:</td>
                                                <td class="text-right">
                                                    <a href="{{route('Download')}}" class="text-purple-500">لینک دانلود</a>
                                                </td>
                                            </tr>
                                            @if($this->isLicence($order->id))
                                            <tr>
                                                <td  class="text-right">لایسنس:</td>
                                                <td class="text-right"> {{$order->licence}} </td>
                                            </tr>
                                            @endif
                                             @if($this->issupport($order->id))
                                            <tr>
                                                <td  class="text-right"> پشتیبانی:</td>
                                                <td class="text-right"> {{$this->support($order->id)}} </td>
                                            </tr>
                                            @endif



                                        <tr>
                                            <td class="text-right">جمع:</td>
                                            <td class="text-right">{{number_format($order->prices)}} تومان</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
