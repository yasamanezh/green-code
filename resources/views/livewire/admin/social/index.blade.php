@section('title','شبکه های اجتماعی')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5"> شبکه های اجتماعی</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> شبکه های اجتماعی</li>
                </ol>
            </div>
            <div>
                <button class="btn btn-primary my-2 btn-icon-text" wire:click.prevent="categoryForm"
                        wire:loading.remove>ذخیره
                </button>
                <div wire:loading wire:target="categoryForm">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 ">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        شبکه های اجتماعی
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <form class="padding-10 categoryForm">
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">تلگرام : </label>
                                    <input type="text" wire:model.lazy="telegram" placeholder=""
                                           class="form-control col-sm-10">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">واتساپ : </label>
                                    <input type="text" wire:model.lazy="whatsapp" placeholder=""
                                           class="form-control col-sm-10">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">توییتر : </label>
                                    <input type="text" wire:model.lazy="twitter" placeholder=""
                                           class="form-control col-sm-10">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">لینکدین : </label>
                                    <input type="text" wire:model.lazy="linkdin" placeholder=""
                                           class="form-control col-sm-10">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">اینستاگرام : </label>
                                    <input type="text" wire:model.lazy="instagram" placeholder=""
                                           class="form-control col-sm-10">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">ایمیل : </label>
                                    <input type="text" wire:model.lazy="email" placeholder=""
                                           class="form-control col-sm-10">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
