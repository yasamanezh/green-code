<div>
   <livewire:front.layouts.header.menu />
   
    <div>
        <div class="chat-online">
            @if($showChat)
            <div class="box-icon-chat box-hide">
                <div class="box-title-chat text-white">
                    <h6>راه های ارتباطی ما</h6>
                    <div class="box-titlt-close" wire:click.prevent="hideChatBox()" style="cursor: pointer">
                        <div>
                            <a ><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                </div>
                <div class="messangers-list-container">
                    <ul class="messangers-list">
                        <li><a href="https://wa.me/+98934054988" target="_blank" class="d-flex ">
                                <div>
                                    <h2 class="h6 m-0"> واتساپ</h2>
                                    <small class="">بخش فروش</small>
                                </div>
                                <span style="background-color:#25D366"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z">
                                    </path>
                                </svg></span>

                            </a></li>
                        <li>
                            <a href="https://t.me/idealadvertising" target="_blank" class="d-flex ">
                                <div>
                                    <h2 class="h6 m-0">تلگرام</h2>
                                    <small class="">بخش توسعه دهندگان</small>
                                </div>
                                <span style="background-color:#20AFDE">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M446.7 98.6l-67.6 318.8c-5.1 22.5-18.4 28.1-37.3 17.5l-103-75.9-49.7 47.8c-5.5 5.5-10.1 10.1-20.7 10.1l7.4-104.9 190.9-172.5c8.3-7.4-1.8-11.5-12.9-4.1L117.8 284 16.2 252.2c-22.1-6.9-22.5-22.1 4.6-32.7L418.2 66.4c18.4-6.9 34.5 4.1 28.5 32.2z">
                                    </path>
                                </svg>
                            </span>

                            </a>
                        </li>
                        <li>
                            <a href="mailto:ideal1386@gmail.com" target="_blank" class="d-flex ">
                                <div>
                                    <h2 class="h6 m-0">ایمیل</h2>
                                    <small class="">ارتباط با ما</small>
                                </div>
                                <span style="background-color:#6F79FF">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h416c8.8 0 16 7.2 16 16v41.4c-21.9 18.5-53.2 44-150.6 121.3-16.9 13.4-50.2 45.7-73.4 45.3-23.2.4-56.6-31.9-73.4-45.3C85.2 197.4 53.9 171.9 32 153.4V112c0-8.8 7.2-16 16-16zm416 320H48c-8.8 0-16-7.2-16-16V195c22.8 18.7 58.8 47.6 130.7 104.7 20.5 16.4 56.7 52.5 93.3 52.3 36.4.3 72.3-35.5 93.3-52.3 71.9-57.1 107.9-86 130.7-104.7v205c0 8.8-7.2 16-16 16z">
                                    </path>
                                </svg>
                            </span>

                            </a>
                        </li>
                        <li>
                            <a href="tel:09384054988" class="d-flex ">
                                <div>
                                    <h2 class="h6 m-0">تماس</h2>
                                    <small class="">تماس تلفنی در ساعات اداری</small>
                                </div>
                                <span style="background-color:#4EB625">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z">
                                    </path>
                                </svg>
                            </span>

                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/green_code_ir" target="_blank" class="d-flex ">
                                <div>
                                    <h2 class="h6 m-0">اینستاگرام</h2>
                                    <small class="">ما را دنبال کنید</small>
                                </div>
                                <span style="background-color:#d3253c">
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="64.000000pt" height="64.000000pt" viewBox="0 0 64.000000 64.000000" preserveAspectRatio="xMidYMid meet">
                                    <g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none">
                                        <path d="M79 617 c-18 -12 -44 -38 -56 -56 -22 -33 -23 -42 -23 -241 0 -199 1 -208 23 -241 12 -18 38 -44 56 -56 33 -22 42 -23 241 -23 199 0 208 1 241 23 18 12 44 38 56 56 22 33 23 42 23 241 0 199 -1 208 -23 241 -12 18 -38 44 -56 56 -33 22 -42 23 -241 23 -199 0 -208 -1 -241 -23z m440 -35 c19 -9 44 -30 55 -45 20 -26 21 -42 21 -217 0 -175 -1 -191 -21 -217 -40 -55 -72 -63 -254 -63 -182 0 -214 8 -254 63 -20 26 -21 42 -21 217 0 175 1 191 21 217 40 55 72 63 254 63 137 0 171 -3 199 -18z"></path>
                                        <path d="M240 478 c-132 -67 -132 -249 0 -316 56 -28 104 -28 160 0 132 67 132 249 0 316 -24 12 -60 22 -80 22 -20 0 -56 -10 -80 -22z m141 -43 c64 -34 87 -120 49 -182 -50 -83 -170 -83 -220 0 -68 111 55 242 171 182z"></path>
                                    </g>
                                </svg>
                            </span>
                            </a>
                        </li>

                    </ul>
                </div>

            </div>
            @endif
            <div class="message-button" id="chat"  wire:click.prevent="shoeChatBox()">
                <div class="item-message-chat-container show-box text-center" style="width: 30px;height: 30px;text-align: center">
                    <i class="fa fa-phone" style="font-size: 18px"></i>
                </div>
            </div>

        </div>
    </div>
</div>
