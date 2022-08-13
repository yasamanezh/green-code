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



                                                <p class="text-center">
                                                    <button type="button" wire:click.prevent="saveInfo"  class="btn btn-success">ارسال</button>
                                                </p>

                                            </div>

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
