<div>
    <div class="container-xxl position-relative p-0 mr-3">

        <div class="container-xxl py-5 bread-margin">
            <div class="container my-5 py-5 px-lg-5" style="margin-right: 10%">
                <div class="row g-5 py-5 ">
                    <div class="col-12 text-center">
                        <h1 class="text-white animated zoomIn"> پرداخت ها</h1>
                        <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Home')}}">خانه</a></li>
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Profile')}}">حساب کاربری</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page"> پرداخت ها</li>
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
                        <div class="profile-content">
                            <div class="headline-profile">
                                <span> سفارش‌ها</span>
                            </div>
                            <div class="profile-stats">
                                <div class="profile-stats-row">
                                    <div class="profile-stats page-profile-order">
                                        <div class="table-orders">
                                            <table class="table">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">کد مرجع</th>
                                                    <th scope="col">درگاه </th>
                                                    <th scope="col">مبلغ</th>
                                                    <th scope="col">تاریخ ایجاد</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td class="order-code">{{$order->transactionId}}</td>
                                                        <td class="detail text-right">
                                                            @if($order->payment_type == 'sepehr')
                                                                بانک صادرات
                                                            @elseif($order->payment_type == 'sadad')
                                                                بانک ملی
                                                            @elseif($order->payment_type == 'zarinpal')
                                                                زرین پال
                                                            @endif
                                                        </td>
                                                        <td class="detail text-right">{{$order->prices}}</td>
                                                        <td class="detail text-right">{{ verta($order->created_at)->format('%d  %B %Y') }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="position-relative pull-left">{{$orders->links()}}</div>
                </div>
            </div>
        </div>
    </div>

</div>
