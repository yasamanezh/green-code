@section('title','مشاهده پیام')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">مشاهده پیام</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">پیام ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> مشاهده پیام</li>
                </ol>
            </div>
            <div class="pull-right">
                <a data-toggle="tooltip" href="{{route('contacts')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
    @include('livewire.admin.layouts.message')
    <!-- Row -->
        <br>
        <br>
        <div class="row row-sm">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        مشاهده پیام
                    </div>
                    <div class="card-body">
                        <div class="table-responsive scrollbar" id="style-1">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td>نام :</td>
                                <td>{{$contact->name}}</td>
                            </tr>
                            <tr>
                                <td>آدرس :</td>
                                <td>{{$contact->email}} </td>
                            </tr>
                            <tr>
                                <td>متن پیام :</td>
                                <td>{{$contact->content}} </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


