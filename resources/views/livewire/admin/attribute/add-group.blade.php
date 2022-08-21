@section('title','افزودن گروه مشخصات')

    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5"> افزودن گروه مشخصات</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                        <li class="breadcrumb-item"><a href="{{route('AttributeGroups')}}">مشخصات</a></li>
                        <li class="breadcrumb-item active" aria-current="page">افزودن گروه مشخصات</li>
                    </ol>
                </div>
                <div>
                    <button class="btn btn-primary" wire:click.prevent="saveInfo" wire:loading.remove>افزودن</button>
                    <div wire:loading wire:target="saveInfo">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    <a data-toggle="tooltip" href="{{route('AttributeGroups')}}" class="btn btn-warning text-white"
                       data-original-title="برگشت">
                        <i class="fa fa-backward"></i>
                    </a>
                </div>
            </div>
            @include('livewire.admin.layouts.error')
            <div class="row row-sm">
                <div class="col-lg-12">
                    @include('livewire.admin.layouts.message')
                    <div class="card custom-card">
                        <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                            افزودن گروه مشخصات
                        </div>
                        <div class="card-body birder">
                            <div class="form-group row">
                                <label class="col-md-2 form-label">عنوان: <span class="tx-danger">*</span></label>
                                <div class="col-md-10">
                                    <input type="text" name="title" placeholder="عنوان "
                                           class="form-control @error('title') is-invalid @enderror"
                                           wire:model.lazy="title">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 form-label">دسته بندی:<span class="tx-danger">*</span></label>
                                <div class="col-md-10">
                                    <select type="text" class="form-control" wire:model.lazy="category_id">
                                        <option value="">انتخاب</option>
                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                                            @if(\App\Models\Category::where('status',1)->where('parent',$cat->id)->first())
                                                @foreach(\App\Models\Category::where('status',1)->where('parent',$cat->id)->get() as $subCategory)
                                                    <option value="{{$subCategory->id}}">{{$cat->title}}
                                                        > {{$subCategory->title}}</option>
                                                    @if(\App\Models\Category::where('status',1)->where('parent',$subCategory->id)->first())
                                                        @foreach(\App\Models\Category::where('status',1)->where('parent',$subCategory->id)->get() as $subCategory1)
                                                            <option value="{{$subCategory1->id}}">{{$cat->title}}
                                                                > {{$subCategory->title}}
                                                                > {{$subCategory1->title}}</option>
                                                        @endforeach
                                                    @endif

                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row row-sm">
                                    <label class="form-label col-sm-2">ترتیب: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input wire:model="sort" placeholder="ترتیب"
                                               class="form-control @error('sort') is-invalid @enderror">
                                        @error('sort')
                                        <div class="invalid-feedback">
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
