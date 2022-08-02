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
                        <a  class="breadcrumb-link active-breadcrumb">پرسش ها</a>
                    </li>
                </ul>
            </div>
        </div>
        @include('livewire.front.profile.sidbar')
        <div class="col-lg-9 col-md-9 col-xs-12 pull-left">
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
    <!--    product-slider----------------------------------->
</div>
