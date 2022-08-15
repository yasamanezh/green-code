@section('title','ویرایش تیکت')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ویرایش تیکت</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('AdminTickets')}}">تیکتها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش تیکت</li>
                </ol>
            </div>
            <div>
                <button  wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.attr="disabled" wire:loading.remove>ذخیره
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('AdminTickets')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        ویرایش تیکت
                    </div>
                    <div class="card-body">
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
                </div>
            </div>
        </div>
    </div>
</div>

