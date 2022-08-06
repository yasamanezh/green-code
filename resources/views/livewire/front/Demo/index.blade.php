<div>

    @foreach($sections as $section)
        <div id="section{{$section->sort}}" >

            @php  $cols=\App\Models\Colum::where('page',$page->title)->where('row',$section->sort)->get() ;   @endphp
            @if($cols)
                @foreach($cols as $col)
                    @foreach(\App\Models\Module::where('page',$page->title)->where('row',$section->sort)->where('col',$col->sort)->get() as $module)
                        <div id="homeSection{{$module->row .$module->col . $module->sort}}"
                        >
                            @php $typeModule=explode(',',$module->module_id);    @endphp
                            @switch($typeModule[0])
                                @case('banner')
                                @if(\App\Models\Banner::where('id',$typeModule[1])->first())
                                    <livewire:front.module.banner :banner="$typeModule[1]">
                                        @endif
                                        @break
                                        @case('html')
                                        @php  $type=$typeModule[1] @endphp
                                        @if(\App\Models\Html::where('id',$type)->first())
                                            <livewire:front.module.html
                                                :html="$type">
                                                @endif
                                                @break
                                                @case('brand')
                                                <livewire:front.module.brand>
                                                    @break
                                                    @case('blog')
                                                    <livewire:front.module.blog>
                                                        @break
                                                        @case('contact')
                                                        <livewire:front.module.contact>
                                                            @break
                                                            @case('logo')
                                                            <livewire:front.module.logo>
                                    @break
                                    @endswitch
                        </div>
                    @endforeach

                @endforeach
            @endif
        </div>
    @endforeach
    @push('moduleCss')
        <style>
            @foreach($sectionclass as $value)
                {{$value}}
            @endforeach
        </style>
    @endpush
</div>




