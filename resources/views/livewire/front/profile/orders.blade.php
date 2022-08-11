<div>
    <div class="container-xxl position-relative p-0 mr-3">

        <div class="container-xxl py-5 bread-margin">
            <div class="container my-5 py-5 px-lg-5" style="margin-right: 10%">
                <div class="row g-5 py-5 ">
                    <div class="col-12 text-center">
                        <h1 class="text-white animated zoomIn"> سفارش‌ها</h1>
                        <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Home')}}">خانه</a></li>
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Profile')}}">حساب کاربری</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page"> سفارش‌ها</li>
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
                                                    <th scope="col">شماره سفارش</th>
                                                    <th scope="col">محصول</th>
                                                    <th scope="col">تاریخ ثبت سفارش</th>
                                                    <th scope="col">عملیات پرداخت</th>
                                                    <th scope="col">فاکتور</th>

                                                    <th scope="col">جزئیات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($orders as $order)
                                                    @if($order->status==200 )
                                                    <tr>
                                                        <td class="order-code">{{$order->order_number}}</td>
                                                        <td class="detail text-right">
                                                            {{$this->title($order->id)}}
                                                        </td>
                                                        @if($order->status == 200)
                                                            <td>{{ verta($order->created_at)->format('%d  %B %Y') }}</td>
                                                        @else
                                                            <td >{{ verta($order->updated_at)->format('%d/ %B  / %Y') }}</td>
                                                        @endif
                                                        <td>@if($order->status ==200)
                                                            <span class="text-success">    پرداخت شده</span>
                                                            @else
                                                                <span class="text-danger">
                                                                 <a class="btn btn-danger" href="{{route('checkoutOrder',$order->order_number)}}">پرداخت</a>
                                                                </span>
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
                                                    @elseif($order->title != null)
                                                        <tr>
                                                            <td class="order-code">{{$order->order_number}}</td>
                                                            <td class="detail text-right">
                                                                {{$this->title($order->id)}}
                                                            </td>
                                                            @if($order->status == 200)
                                                                <td>{{ verta($order->created_at)->format('%d  %B %Y') }}</td>
                                                            @else
                                                                <td >{{ verta($order->updated_at)->format('%d/ %B  / %Y') }}</td>
                                                            @endif
                                                            <td>@if($order->status ==200)
                                                                    <span class="text-success">    پرداخت شده</span>
                                                                @else
                                                                    <span class="text-danger">
                                                                <a class="btn btn-danger" href="{{route('checkoutOrder',$order->order_number)}}">پرداخت</a>
                                                                </span>
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
                                                    @endif
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
