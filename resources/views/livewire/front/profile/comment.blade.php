<div>

    <div class="container-xxl position-relative p-0 mr-3">

        <div class="container-xxl py-5 bread-margin">
            <div class="container my-5 py-5 px-lg-5" style="margin-right: 10%">
                <div class="row g-5 py-5 ">
                    <div class="col-12 text-center">
                        <h1 class="text-white animated zoomIn">تیکت ها</h1>
                        <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Home')}}">خانه</a></li>
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Profile')}}">حساب کاربری</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">تیکت ها</li>
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
                                <span>تیکت ها</span>
                            </div>
                            <a href="{{route('TicketAdd')}}" class="btn btn-primary pull-left" style="margin-left: 23px;" >افزودن تیکت</a>
                            <div class="profile-stats">
                                <div class="profile-stats-row">
                                    <div class="profile-stats page-profile-order">
                                        <div id="product-questions-list">
                                            <div class="table-orders">
                                                <table class="table" wire:poll.120s>
                                                    <thead class="thead-light">
                                                    <tr>

                                                        <th scope="col">تاریخ ثبت تیکت</th>
                                                        <th scope="col">بخش</th>
                                                        <th scope="col">موضوع</th>
                                                        <th scope="col">وضعیت</th>
                                                        <th scope="col">اخرین به روز رسانی</th>
                                                        <th scope="col">مشاهده</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($tickets as $ticket)
                                                        <tr>
                                                            <td>{{ verta($ticket->created_at)->format('%d  %B %Y') }}</td>
                                                            <td>{{$ticket->part}}</td>
                                                            <td>{{$ticket->title}}</td>
                                                            <td>{{$ticket->status ==0 ? 'بسته' : 'باز' }}</td>
                                                            <td>{{ verta($ticket->updates_at)->format('%d  %B %Y') }}</td>
                                                            <td>
                                                                <a href="{{route('TicketEdit',$ticket->id)}}" class="btn btn-sm">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>


                                        <div class="position-relative pull-left">{{$tickets->links()}}</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>

</div>
