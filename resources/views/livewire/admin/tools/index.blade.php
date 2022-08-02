@section('title','ابزار')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5"> ابزار سایت </h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد </a></li>
                    <li class="breadcrumb-item active" aria-current="page"> ابزار سایت</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="pt-0 card custom-card pt-7 bg-background2 card pb-7 border-0 overflow-hidden">
                    <div class="header-text mb-0">
                        <div class="container-fluid p-5">
                            <div class="text-right text-white background-text">
                                <h1 class="mb-3 tx-40 font-weight-semibold">حالت تعمیرات</h1>
                                <p class="tx-18 mb-5 text-white-50">حالت تعمییرات برای خارج کردن سایت از دسترس عموم
                                    انجام میشود .</p>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
                                    <div class="item-search-tabs mb-6 background-text">
                                        <div class="buy-sell">
                                            <div class="form row mx-auto justify-content-center d-flex p-4">
                                                <div class="form-group col-xl-12 col-lg-12 col-md-12 mb-0">
                                                    <p class="tx-14 mb-2 text-white-50">حالت تعمییرات عمومی (در این حالت
                                                        سایت از دسترس همه خارج میشود.)</p>
                                                </div>
                                                <div class="text-center background-text">
                                                    <a wire:click="down" class="btn btn-danger" style="color: white">اجرای
                                                        حالت تعمیرات عمومی</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="item-search-tabs mb-6 background-text">
                                        <div class="buy-sell">
                                            <div class="form row mx-auto justify-content-center d-flex p-4">
                                                <div class="form-group col-xl-6 col-lg-6 col-md-12 mb-0">
                                                    <p class="tx-14 mt-3 mb-5 text-white-50">حالت تعمییرات با کلید (در
                                                        این حالت سایت از دسترس همه بجز کسانی که کلید را وارد کردن خارج
                                                        میشود.)</p>
                                                </div>
                                                <div class="form-group col-xl-6 col-lg-6 col-md-12 mb-0">
                                                    <input wire:model="key" type="text"
                                                           class="form-control mb-5 mb-lg-0 @error('key') is-invalid state-invalid @enderror"
                                                           id="text7" placeholder="کلید خود را وارد کنید ">
                                                </div>
                                                @error('key')
                                                <div class="text-center background-text invalid-feedback"
                                                     style="display: block"><p
                                                        class="tx-14 mb-3 text-red-50">{{ $message }}</p></div>
                                                @enderror
                                                <div class="text-center background-text">
                                                    <a wire:click="secret" class="btn btn-danger" style="color: white">اجرای
                                                        حالت تعمیرات با کلید</a>
                                                </div>
                                            </div>
                                            <div class="text-center background-text">
                                                <a wire:click="up"
                                                   class="btn btn-warning pr-6 pr-6 pt-2 pb-2 mx-auto float-right mt-5"
                                                   style="color: white">خروج از حالت تعمیرات</a>
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
        <div class="row">
            <div class="col-md-12">
                <div class="pt-0 card custom-card pt-7 bg-background2 card pb-7 border-0 overflow-hidden">
                    <div class="header-text mb-0">
                        <div class="container-fluid p-5">
                            <div class="text-right text-white background-text">
                                <h1 class="mb-3 tx-40 font-weight-semibold">خالی کردن کش</h1>
                                <p class="tx-18 mb-5 text-white-50">خالی کردن کش باعث افزایش سرعت می شود.</p>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
                                    <div class="text-center background-text">
                                        <a wire:click="cache" class="btn btn-warning" style="color: white">خالی کردن
                                            کش</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="pt-0 card custom-card pt-7 bg-background2 card pb-7 border-0 overflow-hidden">
                    <div class="header-text mb-0">
                        <div class="container-fluid p-5">
                            <div class="text-right text-white background-text">
                                <h1 class="mb-3 tx-40 font-weight-semibold">سایت مپ</h1>
                                <p class="tx-18 mb-5 text-white-50">لینک سایت مپ سایت برای استفاده در ابزار سئو</p>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 d-block mx-auto">
                                    <div class="text-center background-text">
                                        <button onClick="copy" id="bob" class="btn btn-warning" style="color: white">
                                            کپی کردن لینک
                                        </button>
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
@push('jsAfterCustomJs')
    <script>
        function fallbackCopyTextToClipboard(text) {
            var textArea = document.createElement("textarea");
            textArea.value = text;

            // Avoid scrolling to bottom
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";

            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Fallback: Copying text command was ' + msg);
            } catch (err) {
                console.error('Fallback: Oops, unable to copy', err);
            }

            document.body.removeChild(textArea);
        }

        function copyTextToClipboard(text) {
            if (!navigator.clipboard) {
                fallbackCopyTextToClipboard(text);
                return;
            }
            navigator.clipboard.writeText(text).then(function () {

                console.log('Async: Copying to clipboard was successful!');
            }, function (err) {
                console.error('Async: Could not copy text: ', err);
            });
        }

        var copyBobBtn = document.querySelector('#bob');

        copyBobBtn.addEventListener('click', function (event) {
            copyTextToClipboard('{{env('APP_URL')}}' + '/sitemap.xml');
            alert("لینک با موفقیت کپی شد.");
        });
    </script>
@endpush
