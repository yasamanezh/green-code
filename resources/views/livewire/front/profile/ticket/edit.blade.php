<div>
    <div class="container-xxl position-relative p-0 mr-3">

        <div class="container-xxl py-5 bread-margin">
            <div class="container my-5 py-5 px-lg-5" style="margin-right: 10%">
                <div class="row g-5 py-5 ">
                    <div class="col-12 text-center">
                        <h1 class="text-white animated zoomIn">دانلودها</h1>
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
                        <div class="profile-content">
                            <div class="headline-profile">
                                <span>ایجاد تیکت</span>
                            </div>
                            <div class="profile-stats">
                                <div class="profile-stats-row">
                                    <div class="profile-stats page-profile-order">
                                        <div class="table-orders">
                                             <button wire:ignore class="btn btn-primary pull-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                   پاسخ
                                                </button>
                                            <br>
                                            <br>
                                            <div wire:ignore.self class="collapse" id="collapseExample" >
                                                <div class="form-group">
                                                    <label for="inputMessage"> پیام</label>
                                                    <textarea wire:model.defer="description" id="inputMessage" rows="12" class="form-control"></textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-sm-12">
                                                        <label for="inputAttachments">ضمیمه</label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="file" wire:model.defer="file" id="inputAttachments" class="form-control">
                                                        @error('file')
                                                        <div class="invalid-feedback display-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-xs-12 attachmentsMessage">
                                                        پسوند های مجاز: .jpg, .gif, .jpeg, .png
                                                    </div>
                                                </div>

                                                <div id="customFieldsContainer">
                                                </div>

                                                <div id="autoAnswerSuggestions" class="well hidden"></div>
                                                <p class="text-center">
                                                    <button wire:target="file" wire:loading.attr="disabled" type="button" wire:click.prevent="saveInfo"  class="btn btn-success">ارسال</button>
                                                </p>

                                            </div><br>
                                            <section class="ticket-body">
                                                <div class="col-lg-12 col-md-8 col-xs-12 pull-left">
                                                    <div class="article box1">
                                                        <div class="header pull-right">
                                                            <div>
                                                                {{$ticket->user->name}}
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <p class="pull-right body">
                                                            {{$ticket->title}}
                                                            <br>
                                                            {{$ticket->description}}
                                                        </p>
                                                        @if($ticket->file)
                                                            <a  download="download" href="/storage/{{$ticket->file}}">مشاهده فایل</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </section><br>
                                            @foreach($ticket->answers as $answer)
                                                <section class="ticket-body" style="margin-right: 20px;">
                                                    <div class="col-lg-12 col-md-8 col-xs-12 pull-left">
                                                        <div class="article box1">
                                                            <div class="header pull-right">
                                                                <div>
                                                                    {{$answer->user->name}}
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <p class="pull-right body">

                                                                {{$answer->answer}}
                                                            </p>
                                                            @if($answer->file)
                                                                <a  download="download" href="/storage/{{$answer->file}}">مشاهده فایل</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </section><br>
                                            @endforeach
                                        </div>
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
