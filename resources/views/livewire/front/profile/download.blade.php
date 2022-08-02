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
                        <a class="breadcrumb-link active-breadcrumb">دانلودها</a>
                    </li>
                </ul>
            </div>
        </div>
        @include('livewire.front.profile.sidbar')
        <div class="col-lg-9 col-md-9 col-xs-12 pull-left">
            <section class="page-contents">
                <div class="profile-content">
                    <div class="headline-profile">
                        <span> دانلودها</span>
                    </div>
                    <div class="profile-stats">
                        <div class="profile-stats-row">
                            <div class="profile-stats page-profile-order">
                                <div class="table-orders">
                                    <table class="table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th scope="col">عنوان</th>
                                            <th scope="col">تاریخ ثبت سفارش</th>
                                            <th scope="col">جزئیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($downloads as $download)
                                            <tr>
                                                <td class="order-code">{{$download->title}}</td>
                                                <td class="text-success"> {{verta($download->created_at)}}  </td>
                                                <td class="detail"><a
                                                            href="{{route('DownloadFile',$this->downloadFile($download->id))}}"
                                                            class="text-center" style="display:block;" target="_blank">
                                                        <i class="mdi mdi-download"></i>
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
        </div>
    </div>
    <!--    product-slider----------------------------------->
</div>
