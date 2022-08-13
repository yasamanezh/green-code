@section('title','ایجاد تیکت')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ایجاد تیکت</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('AdminTickets')}}">تیکتها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد تیکت</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
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
                        افزودن تیکت
                    </div>
                    <div class="card-body">
                        <div class="profile-stats">
                            <div class="profile-stats-row">
                                <div class="profile-stats page-profile-order">
                                    <div class="table-orders">
                                        <div >

                                            <div class="row">
                                                <div class="form-group col-sm-6">
                                                    <label for="inputSubject">موضوع</label>
                                                    <input type="text" wire:model="ticket.title" name="title" id="inputSubject" value="" class="form-control">
                                                    @error('ticket.title')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="inputDepartment">بخش</label>
                                                    <select name="part" id="inputDepartment" class="form-control" wire:model="ticket.part">
                                                        <option value="">انتخاب</option>
                                                        <option value="بخش پشتیبانی" >
                                                            بخش پشتیبانی
                                                        </option>
                                                        <option value=" بخش فروش">
                                                            بخش فروش
                                                        </option>
                                                        <option value=" حسابداری">
                                                            حسابداری
                                                        </option>

                                                        <option value=" نظرات و پیشنهادات">
                                                            نظرات و پیشنهادات
                                                        </option>
                                                        <option value="شکایات و تخلفات">
                                                            شکایات و تخلفات
                                                        </option>
                                                        <option value=" طراحی وب سایت">
                                                            طراحی وب سایت
                                                        </option>
                                                    </select>
                                                    @error('ticket.part')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputMessage"> پیام</label>
                                                <textarea wire:model="ticket.description" id="inputMessage" rows="12" class="form-control"></textarea>
                                                @error('ticket.description')
                                                <div class="invalid-feedback display-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-12">
                                                    <label for="inputAttachments">ضمیمه ها</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="file" wire:model="file" id="inputAttachments" class="form-control">
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
</div>

