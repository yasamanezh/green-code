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
                        <a  class="breadcrumb-link active-breadcrumb">سفارشات</a>
                    </li>
                </ul>
            </div>
        </div>
        @include('livewire.front.profile.sidbar')
        <div class="col-lg-9 col-md-9 col-xs-12 pull-left">
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
                                            <th scope="col">شماره سفارش</th>
                                            <th scope="col">تاریخ ثبت سفارش</th>
                                            <th scope="col">عملیات پرداخت</th>
                                            <th scope="col">فاکتور</th>

                                            <th scope="col">جزئیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td class="order-code">{{$order->order_number}}</td>
                                            @if($order->status == 200)
                                                <td>{{ verta($order->created_at)->format('%d  %B %Y') }}</td>
                                            @else
                                                <td >{{ verta($order->updated_at)->format('%d/ %B  / %Y') }}</td>
                                            @endif
                                            <td>@if($order->status ==200)
                                                    @if($order->payment_type=='offline')
                                                        <span class="text-success"> پرداخت موقع تحویل </span>
                                                    @else
                                                        <span class="text-success">آنلاین (موفق) </span>
                                                    @endif
                                                @else
                                                    <span class="text-danger">آنلاین (ناموفق)  </span>
                                                @endif</td>


                                            <td class="detail text-right">
                                                <a target="_blank" class="text-center" href="{{route('PrintOrder',$order->order_number)}}" style="display:block;">
                                                    <i class="fa fa-print"></i>
                                                </a>

                                            </td>
                                            <td class="detail">
                                                <a class="text-center" href="{{route('DetailOrder',$order->order_number)}}" style="display:block;">
                                                    <i class="fa fa-angle-left"></i>
                                                </a>


                                            </td>
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
    <!--    product-slider----------------------------------->
</div>
