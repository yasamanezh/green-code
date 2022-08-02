@section('title','آپدیت')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">آپدیت</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page">آپدیت</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-12 ">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        آپدیت
                    </div>
                    <div class="card-body">
                        @include('livewire.admin.layouts.error')
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <form class="padding-10 categoryForm">
                                <div class="example">
                                    @if($maintenance)
                                        <div class="alert alert-danger" role="alert">
                                            قبل از آپدیت لازم حالت تعمییرات با کلید را فعال کنید. <a
                                                href="{{ route('admin.tools') }}" class="alert-link">با کلیک در
                                                اینجا </a>
                                            حالت تعمییرات با کلید را فعال کنید.
                                        </div>
                                    @else

                                        <nav class="breadcrumb-5">
                                            <div class="breadcrumb flat">
                                                <a class="@if($step == 1)active @endif"><span
                                                        class="badge badge-light ml-3">1 </span><span
                                                        class="breadcrumbitem">بارگزاری </span></a>
                                                <a class="@if($step == 2)active @endif"><span
                                                        class="badge badge-light ml-3">2 </span><span
                                                        class="breadcrumbitem">پیام ها </span></a>
                                                <a class="@if($step == 3)active @endif"><span
                                                        class="badge badge-light ml-3">3 </span><span
                                                        class="breadcrumbitem">نصب </span></a>
                                            </div>
                                        </nav>
                                        @if($step == 1)
                                            <div class="form-group row pt-2">
                                                <label class="form-label col-sm-2">انتخاب فایل بروزرسانی : </label>
                                                <input type="file" wire:model="file"
                                                       class="form-control col-sm-8">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="submit"
                                                    wire:click.prevent="sub1"
                                                    wire:loading.remove wire:target="file">رفتن به مرحله بعد
                                            </button>
                                            <div class="text-center">
                                                <div class="lds-facebook" wire:loading
                                                     wire:target="file">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        @elseif($step == 2)
                                            <div class="form-group row pt-2">
                                                {!! $alert !!}
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="submit"
                                                    wire:click.prevent="sub2"
                                                    wire:loading.remove wire:target="sub2">نصب آپدیت
                                            </button>
                                            <div class="text-center">
                                                <div class="lds-facebook" wire:loading
                                                     wire:target="sub2">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        @elseif($step == 3)
                                            <div class="form-group row pt-2">
                                                {!! $done !!}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
