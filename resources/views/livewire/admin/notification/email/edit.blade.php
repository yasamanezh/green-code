@section('title','ویرایش ایمیل')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ویرایش ایمیل</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('EmailNotification')}}">ایمیل ها </a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش ایمیل</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="categoryForm" class="btn btn-primary my-2 btn-icon-text submit"
                        type="submit" for="form" wire:loading.attr="disabled" wire:loading.remove>ویرایش
                </button>
                <div wire:loading wire:target="categoryForm">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('EmailNotification')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        ویرایش ایمیل
                    </div>
                    <div class="card-body">
                        <form id="form" enctype="multipart/form-data" role="form" class="padding-10 categoryForm">
                            <div class="form-group row">
                                <label class="form-label col-sm-2">عنوان: <span class="tx-danger">*</span></label>
                                <input type="text" wire:model.defer="email.subject" placeholder="عنوان ایمیل "
                                       class="form-control col-sm-10">
                            </div>
                            <div class="form-group row">
                                <label class="form-label col-sm-2">محتوای ایمیل: <span class="tx-danger">*</span></label>
                                <textarea type="text" wire:model.defer="email.content" class="form-control col-sm-10"></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="showproducts" class="form-label col-sm-2">کاربران:</label>
                                <div class="col-sm-10">
                                    <div style="height:150px;width:200px;overflow:auto">
                                        <label class="ckbox submit">
                                            <input name="selected" wire:model="SelectAll" type="checkbox">
                                            <span  class="tx-13">انتخاب همه</span>
                                        </label>
                                        @foreach($users as $user)
                                            <div>
                                                <label class="ckbox">
                                                    <input wire:model.defer="showUserIds" type="checkbox"
                                                           value="{{$user->id}}">
                                                    <span> {{$user->name}}</span></label></label>
                                            </div>

                                        @endforeach
                                    </div>
                                    @error('selected')
                                    <div class="invalid-feedback display-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row" wire:ignore>
                                <label class="form-label col-sm-2">زمان ارسال: <span class="tx-danger">*</span></label>
                                <input wire:model.defer="expire" id="inlineExampleAlt"
                                       class="datepicker-demo form-control col-sm-4" disabled required wire:ignore/>
                                <div class="inline-example col-sm-4" wire:ignore></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('customcss')
    <link href="{{asset('admin/plugins/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" rel="stylesheet">

@endpush

@push('jsBeforCustomJs')

    <!-- Internal Quill js-->
    <script src="{{asset('admin/plugins/quill/quill.min.js')}}"></script>
    <script>
        $(function () {
            $('#showUserIds').select2({
                theme: 'bootstrap4',
            }).on('change', function () {
            @this.
            set('showUserIds', $('#showUserIds').val());
            })
        })
    </script>
    <script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script type="text/javascript"
            src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    <script>
        $('.inline-example').persianDatepicker({
            inline: true,
            altField: '#inlineExampleAlt',
            altFormat: 'YYYY/MM/DD-HH:mm',
            toolbox: {
                calendarSwitch: {
                    enabled: false
                },
            },
            navigator: {
                scroll: {
                    enabled: false
                }
            },
            minDate: new persianDate().valueOf(),
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                },
                second: {
                    enabled: false,
                    step: null
                },

            }
        });
    </script>
    <script>
        $('.submit').on('click', function () {
            var x = document.getElementById("inlineExampleAlt").value;
        @this.
        set('expire', toEnglishDigits(x));
        })

        function toEnglishDigits(str) {

            // convert persian digits [۰۱۲۳۴۵۶۷۸۹]
            var e = '۰'.charCodeAt(0);
            str = str.replace(/[۰-۹]/g, function (t) {
                return t.charCodeAt(0) - e;
            });

            // convert arabic indic digits [٠١٢٣٤٥٦٧٨٩]
            e = '٠'.charCodeAt(0);
            str = str.replace(/[٠-٩]/g, function (t) {
                return t.charCodeAt(0) - e;
            });
            return str;
        }
    </script>
@endpush
