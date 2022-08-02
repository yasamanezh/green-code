@section('title','ویرایش کاربر')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ویرایش کاربر</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('Users')}}">فهرست کاربران</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش کاربر</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="updateUser" class="btn btn-primary my-2 btn-icon-text" type="submit" wire:loading.attr="disabled">ویرایش</button>
                <div wire:loading wire:target="updateUser" wire:loading.remove>
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('Users')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        ویرایش کاربر -  {{$user->name}}
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 form-label" >تصویر :  </label>
                            <div class="col-sm-10">
                                <br>
                                @if($photo)
                                    <img src="{{$photo->temporaryUrl()}}"
                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                         id="picture">
                                @elseif($img)
                                    <img src="/storage/{{$img}}"
                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                         id="picture">
                                @else
                                    <img id="picture" style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"  src="{{ asset('assets/uploadicon.png')}}"
                                @endif
                                <br>  <br>
                                <input name="img"  type="file" wire:model.lazy="photo"  style="display:none"  id="fileinput" />
                                @error('photo')
                                <div class="invalid-feedback display-block">
                                    {{ $message }}
                                </div>
                                @enderror
                                <span class="mt-2 text-danger" wire:loading wire:target="img">در حال آپلود ...</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name " class="form-label col-sm-2">نام و نام خانوادگی:<span class="tx-danger"> * </span></label>
                            <input type="text" wire:model.defer="state.name"
                                   class="form-control col-sm-10 @error('name') is-invalid @enderror" id="name"
                                   aria-describedby="nameHelp" placeholder="نام و نام خانوادگی را وارد کنید">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="form-label col-sm-2">شماره موبایل:<span class="tx-danger"> * </span></label>
                            <input type="text" wire:model.defer="state.phone"
                                   class="form-control col-sm-10 @error('phone') is-invalid @enderror" id="phone"
                                   aria-describedby="phoneHelp" placeholder="شماره موبایل را وارد کنید">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="password" class="form-label col-sm-2">کلمه عبور</label>
                            <input type="password" wire:model.defer="state.password"
                                   class="form-control col-sm-10 @error('password') is-invalid @enderror" id="password"
                                   placeholder="کلمه عبور">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="passwordConfirmation" class="form-label col-sm-2">تکرار کلمه عبور</label>
                            <input type="password" wire:model.defer="state.password_confirmation" class="form-control col-sm-10"
                                   id="passwordConfirmation" placeholder="تکرار کلمه عبور">
                        </div>
                        <div class="form-group row">
                            <label for="passwordConfirmation" class="form-label col-sm-2">نقش کاربر</label>
                            <select class="form-control col-sm-10" wire:model="role" >
                                <option value="admin" {{ ($user->role === 'admin') ? 'selected' : '' }}>ادمین سایت</option>
                                <option value="hamkar" {{ ($user->role === 'hamkar') ? 'selected' : '' }}>همکار سایت</option>
                                <option value="user" {{ ($user->role === 'user') ? 'selected' : '' }}>کاربر عادی</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback display-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div style="display: {{$role =='hamkar' ? 'block':'none'}}">
                        <div class="form-group row" >
                            <label for="AdminRoles" class="form-label col-sm-2">سطح دسترسی :</label>
                            <div class="col-sm-10">
                                <x-inputs.select2 wire:model.defer="AdminRoles" id="AdminRoles"   >
                                    @foreach($roles as $value)
                                        <option value="{{$value->id}}" >{{$value->label}}</option>
                                    @endforeach
                                </x-inputs.select2>
                                @error('AdminRoles')
                                <div class="invalid-feedback display-block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        </div>
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
@endpush

@push('jsBeforCustomJs')

    <!-- Internal Quill js-->
    <script src="{{asset('admin/plugins/quill/quill.min.js')}}"></script>

    <script>
        $(function () {
            $('#AdminRoles').select2({
                theme: 'bootstrap4',
            }).on('change', function () {
            @this.
            set('AdminRoles', $('#AdminRoles').val());
            })
        })
    </script>
@endpush



