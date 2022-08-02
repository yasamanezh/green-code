@section('title','ویرایش پست')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">ویرایش پست</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                    <li class="breadcrumb-item"><a href="{{route('post.blog')}}">پست ها</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ویرایش پست</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit" wire:loading.remove
                        wire:loading.attr="disabled">ذخیره
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('post.blog')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <form id="form" class="form-horizontal">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card custom-card ">
                        <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                            ویرایش -{{$post->title}}
                        </div>
                        <div class="card-body border">
                            <div id="tab-general">
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">تصویر: <span class="tx-danger">*</span></label>
                                    <div class="col-sm-10">
                                        @if($uploadImage)
                                            <img src="{{ $uploadImage->temporaryUrl() }}"
                                                 style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                 id="picture">
                                        @else
                                            <img id="picture"
                                                 style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                 src="/storage/{{ $post->image}}">

                                        @endif
                                        <br>
                                        <input type="file" class="form-control " style="display:none" id="fileinput"
                                               wire:model.defer="uploadImage" accept="image/*">
                                        <span class="mt-2 text-danger" wire:loading
                                              wire:target="uploadImage">در حال آپلود ...</span>
                                        <br>
                                            @error('uploadImage')
                                            <div class="invalid-feedback display-block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2">عنوان: <span class="tx-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input wire:model.defer="post.title" name="post.title" placeholder="عنوان"
                                                   class="form-control">
                                            @error('post.title')
                                            <div class="invalid-feedback display-block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2">لینک: <span
                                                class="tx-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <input wire:model.defer="post.slug" name="post.slug" placeholder="لینک"
                                                   class="form-control">
                                            @error('post.slug')
                                            <div class="invalid-feedback display-block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2">دسته بندی: <span
                                                class="tx-danger">*</span></label>
                                        <div class="col-sm-10">
                                            <x-inputs.select2 class="form-control" multiple
                                                              style="width: 100%;height:220px"
                                                              id="showcategories" wire:model.defer="showcategories">
                                                <option selecte="selected">انتخاب</option>
                                                @foreach ($categories as $key => $value)
                                                    <option value="{{ $value->id }}">
                                                        {{ $value->title }}
                                                    </option>
                                                @endforeach
                                            </x-inputs.select2>
                                            @error('showcategories')
                                            <div class="invalid-feedback display-block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="message" class="col-sm-2 form-label">توضیحات<span class="tx-danger">*</span></label>
                                    <div class="col-sm-10" wire:ignore>
                                                <textarea rows="10" id="summernote-editor"
                                                          class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                          name="message" wire:model="post.description"
                                                          autocomplete="off">{{$post->description }}</textarea>
                                        @if ($errors->has('message'))
                                            <span class="invalid-feedback " role="alert">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2">متا کلمات کلیدی: </label>
                                        <div class="col-sm-10">
                                            <input wire:model.defer="post.meta_keyword" name="post.meta_keyword"
                                                   placeholder="متا تگ کلمات کلیدی"
                                                   class="form-control">
                                            @error('post.meta_keyword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2">متا تگ عنوان: </label>
                                        <div class="col-sm-10">
                                            <textarea wire:model.defer="post.meta_title" name="post.meta_title"
                                                      rows="5" placeholder="متا تگ عنوان"
                                                      class="form-control"></textarea>
                                            @error('post.meta_title')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2">متا تگ توضیحات: </label>
                                        <div class="col-sm-10">
                                            <textarea wire:model.defer="post.meta_description" name="post.meta_description"
                                                      rows="5" placeholder="متا تگ توضیحات"
                                                      class="form-control"></textarea>
                                            @error('post.meta_description')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row row-sm">
                                        <label class="form-label col-sm-2">وضعیت: </label>
                                        <div class="col-sm-10">
                                            <select wire:model.defer="post.status" name="post.status" class="form-control">
                                                <option value="1">بله</option>
                                                <option value="0">خیر</option>
                                            </select>
                                            @error('post.status')
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
        </form>
    </div>
</div>
@push('customcss')

    <!-- Internal Quill css-->
    <link href="{{asset('admin/plugins/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('admin/plugins/quill/quill.bubble.css')}}" rel="stylesheet">

    <!-- Internal Summernote css-->
    <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}">


    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>

@endpush
@push('jsBeforCustomJs')
    <!-- Internal Quill js-->
    <script src="{{asset('admin/plugins/quill/quill.min.js')}}"></script>

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
                @this.set('post.description', contents);
                }
            },
        });

    </script>
    <script>
        $(function () {
            $('#showcategories').select2({
                theme: 'bootstrap4',
            }).on('change', function () {
            @this.set('showcategories', $('#showcategories').val());
            })
        })
    </script>

@endpush

