<div class="no-bottom no-top" id="content">
    <div id="top"></div>

    <!-- section begin -->
    <section id="subheader" class="jarallax">
        <img src="{{asset('images/background/subheader.jpg')}}" class="jarallax-img" alt="گرینکد">
        <div class="center-y relative text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>ارتباط با ما</h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->
    <section aria-label="section">
        <div class="container rtl-dir">
            <div class="row g-custom-x">
                <div class="col-lg-8 mb-sm-30">
                    <div class="de-map-wrapper">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d207397.0767035316!2d51.429738!3d35.687359!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e00491ff3dcd9%3A0xf0b3697c567024bc!2sTehran%2C%20Tehran%20Province%2C%20Iran!5e0!3m2!1sen!2sus!4v1664289966674!5m2!1sen!2sus"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <div class="spacer-30"></div>

                    <div id="contact_form" class="form-border" >
                        @if($success)
                        <div  class="success">
                            پیام شما ارسال شد و در اولین فرصت پاسخ داده خواهد شد.
                        </div>
                        @endif
                        <br>
                        <div class="row">
                            <div class="col-md-4 mb10">
                                <div class="field-set">
                                    <input wire:model.defer="contact.name" type="text"  id="name" class="form-control @error('contact.name') error_input  @enderror" placeholder="نام شما"
                                           >
                                    @error('contact.name')
                                    <div  class="error">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb10">
                                <div class="field-set">
                                    <input wire:model.defer="contact.email" type="text" name="Email" id="email" class="form-control @error('contact.email') error_input  @enderror" placeholder="ایمیل"
                                           >
                                    @error('contact.email')
                                    <div  class="error">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb10">
                                <div class="field-set">
                                    <input type="text" wire:model.defer="contact.phone" id="phone" class="form-control @error('contact.phone') error_input  @enderror"
                                           placeholder="شماره تماس" >
                                    @error('contact.phone')
                                    <div  class="error">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="field-set mb20">
                            <textarea  wire:model.defer="contact.content" id="message" class="form-control @error('contact.content') error_input  @enderror" placeholder="متن پیام"
                                      ></textarea>
                            @error('contact.content')
                            <div  class="error">
                              {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div id='submit' class="mt20">
                            <button type='submit' id='send_message' wire:click.prevent="saveInfo()"  class="btn-main">ارسال پیام</button>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="padding40 box-rounded mb30" data-bgcolor="#F2F6FE">
                        <h4>پشتیبان فنی</h4>
                        <address class="s1">
                            <span><i class="id-color fa fa-phone fa-lg"></i>09199041290</span>
                            <span><i class="id-color fa fa-envelope-o fa-lg"></i><a href="mailto:contact@example.com">support@green-code.ir</a></span>
                        </address>
                    </div>


                    <div class="padding40" data-bgcolor="#F2F6FE">
                        <h4>دپارتمان برنامه نویسی</h4>
                        <address class="s1">
                            <span><i class="fa fa-phone fa-lg"></i>09384054988</span>
                            <span><i class="fa fa-envelope-o fa-lg"></i><a href="mailto:contact@example.com">info@green-code.ir</a></span>
                        </address>
                    </div>

                </div>

            </div>
        </div>

    </section>

</div>
