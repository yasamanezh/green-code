@section('title','ایجاد منو')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ایجاد منو</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('Menus')}}">منوها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد منو</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.attr="disabled" wire:loading.remove>ذخیره
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('Menus')}}" class="btn btn-warning text-white"
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
                        افزودن منو
                    </div>
                    <div class="card-body">
                        <form>
                            <div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-label">عنوان: <span class="tx-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" name="title" placeholder="نام منو "
                                               class="form-control @error('title') is-invalid @enderror"
                                               wire:model.defer="title">
                                        @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-label">لینک:<span class="tx-danger"> * </span></label>
                                    <div class="col-md-10">

                                        <select type="text" class="form-control @error('link') is-invalid @enderror"
                                                wire:model.defer="link">
                                            <option value="">انتخاب</option>
                                            <option value="blog,1">وبلاگ</option>
                                            @foreach($Pages as $page)
                                                <option value="page,{{$page->id}}">{{$page->title}}</option>
                                            @endforeach
                                            @foreach($Posts as $post)
                                                <option value="post,{{$post->id}}">{{$post->title}}</option>
                                            @endforeach
                                            @foreach($blogs as $blogCategory)
                                                <option
                                                    value="blogCategory,{{$blogCategory->id}}">{{$blogCategory->title}}</option>
                                            @endforeach
                                            @foreach($categories as $cat)
                                                <option value="category,{{$cat->id}}">{{$cat->title}}</option>
                                                @if(\App\Models\Category::where('status',1)->where('parent',$cat->id)->first())
                                                    @foreach(\App\Models\Category::where('status',1)->where('parent',$cat->id)->get() as $subCategory)
                                                        <option value="category,{{$subCategory->id}}">{{$cat->title}} > {{$subCategory->title}}</option>
                                                        @if(\App\Models\Category::where('status',1)->where('parent',$subCategory->id)->first())
                                                            @foreach(\App\Models\Category::where('status',1)->where('parent',$subCategory->id)->get() as $subCategory1)
                                                                <option value="category,{{$subCategory1->id}}">{{$cat->title}} > {{$subCategory->title}} > {{$subCategory1->title}}</option>
                                                            @endforeach
                                                        @endif

                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('link')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2">ترتیب: <span
                                                class="tx-danger">*</span></label>
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
                                <br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

