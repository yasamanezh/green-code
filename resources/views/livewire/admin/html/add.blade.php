@section('title','افزودن html')
<div>
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">افزودن html</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">داشبورد</a></li>
                        <li class="breadcrumb-item"><a href="{{route('Htmls')}}">ماژول های html</a></li>
                        <li class="breadcrumb-item active" aria-current="page">افزودن html</li>
                    </ol>
                </div>
                <div>
                    <button wire:click.prevent="saveInfo" wire:loading.remove id="submit" type="submit"
                            class="btn btn-primary">ذخیره
                    </button>
                    <div wire:loading wire:target="saveInfo">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                    <a data-toggle="tooltip" href="{{route('Htmls')}}" class="btn btn-warning text-white"
                       data-original-title="برگشت">
                        <i class="fa fa-backward"></i>
                    </a>
                </div>
            </div>
            @include('livewire.admin.layouts.error')
            <form id="form-product" class="form-horizontal">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card custom-card ">
                            <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                                افزودن ماژول html
                            </div>
                            <div class="card-body border">
                                <div id="tab-general">
                                    <div class="form-group">
                                        <div class="row row-sm">
                                            <label class="form-label col-sm-2">عنوان: <span
                                                        class="tx-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <input class="form-control @error('html.title') parsley-error @enderror"
                                                       wire:model.defer="html.title">
                                                @error('html.title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="message" class="col-sm-2 form-label">توضیحات:<span
                                                    class="ml-2 text-danger">*</span></label>
                                        <div class="col-sm-10" wire:ignore>
                                        <textarea rows="10" id="summernote-editor"
                                                  class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                  name="message" wire:model="html.description"
                                                  autocomplete="off"></textarea>
                                            @if ($errors->has('message'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                            @endif
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
                        set('html.description', contents);
                    }
                },
            });
        </script>
    @endpush


</div>
