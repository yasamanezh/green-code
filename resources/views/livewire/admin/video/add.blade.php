@section('title','ایجاد ویدئو')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ایجاد ویدئو</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('Videos')}}">ویدئوها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ایجاد ویدئو</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.attr="disabled" wire:loading.remove>ذخیره
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('Videos')}}" class="btn btn-warning text-white"
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
                        افزودن ویدئو
                    </div>
                    <div class="card-body">
                        <form>
                            <div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-label">عنوان: <span class="tx-danger">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" name="title" placeholder="نام ویدئو "
                                               class="form-control @error('video.title') is-invalid @enderror"
                                               wire:model.defer="video.title">
                                        @error('video.title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-label">لینک:<span class="tx-danger"> * </span></label>
                                    <div class="col-md-10">

                                        <input type="text" class="form-control @error('video.link') is-invalid @enderror"
                                                wire:model.defer="video.link">
                                        @error('video.link')
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
                                            <input wire:model="video.sort" placeholder="ترتیب"
                                                   class="form-control @error('video.sort') is-invalid @enderror">
                                            @error('video.sort')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2">محصول: <span
                                                class="tx-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <select wire:model="video.product_id"
                                                   class="form-control
                                           @error('video.product_id') is-invalid @enderror">
                                                <option value="">انتخاب</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">
                                                        {{$product->title}}-
                                                        {{App\Models\Category::where('id',$product->category)->pluck('title')->first()}}


                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('video.product_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2"> وضعیت:</label>
                                        <div class="col-sm-10">
                                            <select wire:model="video.status"
                                                   class="form-control
                                           @error('video.status') is-invalid @enderror">
                                                <option value="0">غیر فعال</option>
                                                <option value="1"> فعال</option>

                                            </select>
                                            @error('video.status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="message" class="col-sm-2 form-label">توضیحات:</label>
                                    <div class="col-sm-10" wire:ignore>
                                                <textarea rows="10" id="summernote-editor"
                                                          class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                          name="message" wire:model="video.description"
                                                          autocomplete="off"></textarea>
                                        @if ($errors->has('message'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                        @endif
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
@push('customcss')

    <!-- Internal Summernote css-->
        <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">

@endpush

@push('jsBeforCustomJs')

     <!-- Internal Summernote js-->
        <script src="{{asset('admin/plugins/summernote/summernote-bs4.js')}}"></script>

        <!-- Internal Form-editor js-->
        <script src="{{asset('admin/js/form-editor.js')}}"></script>

        <script>
            // Define function to open filemanager window
            var lfm = function (options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                window.open(route_prefix + '?type=' + options.type || 'image', 'FileManager', 'width=900,height=600');
                window.SetUrl = cb;
            };

            // Define LFM summernote button
            var LFMButton = function (context) {
                var ui = $.summernote.ui;
                var button = ui.button({
                    contents: '<i class="note-icon-picture"></i> ',
                    tooltip: 'Insert image with filemanager',
                    click: function () {

                        lfm({type: 'image', prefix: '/laravel-filemanager'}, function (lfmItems, path) {
                            lfmItems.forEach(function (lfmItem) {
                                context.invoke('insertImage', lfmItem.url);
                            });
                        });

                    }
                });
                return button.render();
            };
            $('#summernote-editor').summernote({

                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['popovers', ['lfm']],
                ],
                buttons: {
                    lfm: LFMButton
                },
                height: 200,

                callbacks: {
                    onChange: function (contents, $editable) {
                    @this.
                    set('video.description', contents);
                    }
                },
            });
            $('#summernote-editor1').summernote({

                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['popovers', ['lfm']],
                ],
                buttons: {
                    lfm: LFMButton
                },
                height: 200,

                callbacks: {
                    onChange: function (contents, $editable) {
                    @this.
                    set('product.naghd', contents);
                    }
                },
            });
        </script>

    @endpush
</div>

