@section('title','داشبورد')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">خوش آمدید</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">داشبورد</li>
                </ol>
            </div>

        </div>
        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xxl-12 col-xl-12 col-md-12 col-lg-12">
                <div class="card custom-card">
                    <div class="card-header border-bottom-0 pb-1">
                        <label class="main-content-label mb-2 pt-1">آخرین پیام ها</label>
                        <p class="tx-12 mb-0 text-muted">آخرین پیام های ثبت شده در فروشگاه شما</p>
                    </div>
                    <div class="product-timeline card-body pt-3 mt-1">
                        <div class="table-responsive">
                            <table class="table dataTable no-footer dtr-inline ">

                                <thead role="rowgroup">
                                <tr role="row" class="title-row">

                                    <th>نام</th>
                                    <th>ایمیل</th>
                                    <th>متن پیام</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($contacts as $value)

                                    <tr role="row">

                                        <td> {{$value->name}}</td>
                                        <td> {{$value->email}}</td>
                                        <td> {{\Illuminate\Support\Str::limit($value->content, 30)}}</td>

                                        <td>
                                            <a href="{{route('showContact',$value->id)}}" class="btn btn-sm btn-info">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>


                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->


    </div>
</div>
