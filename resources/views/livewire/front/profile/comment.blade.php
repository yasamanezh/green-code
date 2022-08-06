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
                                <li class="breadcrumb-item text-white active" aria-current="page">پرسش ها</li>
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
                            <div class="headline-profile">
                                <span> پرسش ها</span>
                            </div>
                            <div class="profile-stats">
                                <div class="profile-stats-row">
                                    <div class="profile-stats page-profile-order">
                                        <div id="product-questions-list">
                                            @foreach($questions as $value)
                                                <div id="product-questions-list">
                                                    <div class="questions-list">
                                                        <ul class="faq-list">
                                                            <li class="is-question">
                                                                <div class="section">
                                                                    <div class="faq-header">
                                                                        <span class="icon-faq">?</span>


                                                                    </div>
                                                                    پرسش:
                                                                    {{$value->question}}
                                                                    <div class="faq-date">
                                                                        <em> {{ verta($value->created_at)->format('%d/ %B  / %Y') }}</em>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @if($value->answer)
                                                        <div class="questions-list answer-questions">
                                                            <ul class="faq-list">
                                                                <li class="is-question">
                                                                    <div class="section">
                                                                        <div class="faq-header">
                                                                            <span class="icon-faq"><i class="mdi mdi-storefront"></i></span>

                                                                        </div>
                                                                        <span class="pull-right"> پاسخ فروشنده :</span>
                                                                        <p>{{$value->answer}}</p>
                                                                        <div class="faq-date">
                                                                            <em>{{ verta($value->updated_at)->format('%d/ %B  / %Y') }}</em>
                                                                        </div>

                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif

                                                </div>
                                            @endforeach

                                        </div>


                                        <div class="position-relative pull-left">{{$questions->links()}}</div>
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
