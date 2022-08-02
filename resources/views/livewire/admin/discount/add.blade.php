@section('title','افزودن کد تخفیف')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">افزودن تخفیف</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('discounts')}}">تخفیفات</a></li>
                    <li class="breadcrumb-item active" aria-current="page">افزودن تخفیف</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="categoryForm" class="btn btn-primary my-2 btn-icon-text submit"
                        type="submit" wire:loading.remove for="form" wire:loading.attr="disabled">افزودن
                </button>
                <div wire:loading wire:target="categoryForm">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('discounts')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        @if($isError)

            <div class="alert alert-danger">
                <ul>
                    <li> لطفا یکی از مقادیر در صد تخفیف یا مقدار تخفیف (تومان) را وارد کنید.</li>
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        افزودن تخفیف
                    </div>
                    <div class="card-body">
                        <form id="form" enctype="multipart/form-data" role="form" class="padding-10 categoryForm">
                            <div class="form-group row">
                                <label class="form-label col-sm-2">نوع تخفیف</label>
                                <select type="text" wire:model="discount.type_discount" class="form-control col-sm-10 submit">
                                    <option value="">انتخاب</option>
                                    <option value="1">تخفیف روی چند محصول</option>
                                    <option value="3">تخفیف روی کل محصولات</option>
                                    <option value="4">کوپن</option>
                                    <option value="5">تخفیف روی سبد خرید</option>
                                </select>
                            </div>
                            <div style="display: {{$DiscountType ==1 ? 'block':'none'}}">
                                <div class="form-group row">
                                    <label for="showproducts" class="form-label col-sm-2">محصولات تخفیفی:</label>
                                    <div class="col-sm-10">
                                        <div class="scrollbar" id="style-1"
                                             style="height:150px;width:200px;overflow:auto" class="submit">
                                            @foreach($categories as $category)
                                                <div>
                                                    <label class="ckbox submit">
                                                        <input wire:model="selectGroup.{{$category->id}}"
                                                               type="checkbox" value="{{ $category->id }}">
                                                        <span>--{{$category->title}}--</span></label>
                                                </div>
                                                @foreach(\App\Models\Product::where('category',$category->id)->get() as $product)
                                                    <div>
                                                        <label class="ckbox submit">
                                                            <input wire:model="selected" type="checkbox"
                                                                   value="{{$product->id}}">
                                                            <span> {{$product->title}}</span></label></label>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                        @error('selected')
                                        <div class="invalid-feedback display-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">محصولات شگفت انگیز:</label>
                                    <div class="col-sm-10">
                                        <select wire:model.defer="discount.special" class="form-control">
                                            <option value="0">خیر</option>
                                            <option value="1">بله</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="display: {{$DiscountType ==4 ? 'block':'none'}}">
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">کد تخفیف : <span
                                            class="tx-danger">*</span></label>
                                    <input type="text" wire:model.defer="discount.code" placeholder="کد تخفیف "
                                           class="form-control col-sm-10">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">تعداد : <span class="tx-danger">*</span></label>
                                    <input type="text" wire:model.defer="discount.count" placeholder="مثلا 4"
                                           class="form-control col-sm-10">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2"> مقدار تخفیف (تومان) : <span
                                            class="tx-danger">*</span></label>
                                    <input type="text" wire:model.defer="discount.price" placeholder="مثلا 4000"
                                           class="form-control col-sm-10">
                                </div>
                            </div>
                            <div style="display: {{$DiscountType ==5 ? 'block':'none'}}">
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">حداقل سفارش: <span
                                            class="tx-danger">*</span></label>

                                    <input wire:model.lazy="discount.minimum" class="form-control col-sm-10"
                                           placeholder="حداقل سفارش خرید برای تخفیف بر حسب تومان ">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">حداکثر سفارش: <span
                                            class="tx-danger">*</span></label>

                                    <input wire:model.lazy="discount.max" class="form-control col-sm-10"
                                           placeholder="حداکثر سفارش خرید برای تخفیف بر حسب تومان">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2"> مقدار تخفیف (تومان) : <span
                                            class="tx-danger">*</span></label>
                                    <input type="text" wire:model.defer="discount.price" placeholder="مثلا 4000"
                                           class="form-control col-sm-10">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="form-label col-sm-2">درصد تخفیف: <span class="tx-danger">*</span></label>
                                <input type="text" wire:model.defer="discount.percent" placeholder="درصد تخفیف "
                                       class="form-control col-sm-10">
                            </div>
                            <div class="form-group row" wire:ignore>
                                <label class="form-label col-sm-2">زمان انقضاء: <span class="tx-danger">*</span></label>
                                <input wire:model.defer="expire" id="inlineExampleAlt"
                                       class="datepicker-demo form-control col-sm-4" disabled required wire:ignore/>
                                <div class="inline-example col-sm-6" wire:ignore></div>
                            </div>
                            <div class="form-group">
                                <div class="row row-sm">
                                    <label class="col-sm-2 form-label">وضعیت</label>
                                    <select class="form-control col-sm-10" wire:model.defer="discount.status"
                                            name="discount.status">
                                        <option value="">انتخاب کنید</option>
                                        <option value="1">فعال</option>
                                        <option value="0">غیر فعال</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('customcss')

    <!-- Internal Quill css-->
    <link href="{{asset('admin/plugins/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" rel="stylesheet">

@endpush

@push('jsBeforCustomJs')

    <!-- Internal Quill js-->
    <script src="{{asset('admin/plugins/quill/quill.min.js')}}"></script>

    <script>
        $(function () {
            $('#showproducts').select2({
                theme: 'bootstrap4',
            }).on('change', function () {
            @this.set('showproducts', $('#showproducts').val());
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
        @this.set('expire', toEnglishDigits(x));
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

