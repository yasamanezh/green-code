<div>
    <div class="container-main">
    <div class="loading" wire:loading>Loading&#8230;</div>
    <div class="col-12">
        <div class="breadcrumb-container mt-2">
            <ul class="js-breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                </li>
                <li class="breadcrumb-item ">
                    <a href=""  class="breadcrumb-link active-breadcrumb">{{$page->title}}</a>
                </li>

            </ul>
        </div>
    </div>
    <div>
        @foreach($sections as $section)

            <div class="{{$section->fullpage}}">
                <div class="container-main ">
                    <div id="section{{$section->sort}}" class="position-relative " style="    display: block;  width: 100%; float: right;">
                        @php  $cols=\App\Models\Colum::where('page',$page->title)->where('row',$section->sort)->get();   @endphp
                        @if($cols)
                            @foreach($cols as $col)
                                <div class="{{$col->col=='hidden-sm' ?  'hidden-sm' : 'col-sm-'.$col->col}} {{$col->col_md=='hidden-md' ?  'hidden-md' : 'col-md-'.$col->col_md}} {{$col->col_lg=='hidden-lg' ?  'hidden-lg' : 'col-lg-'.$col->col_lg}} {{$col->col_xs=='hidden-xs' ?  'hidden-xs' : 'col-xs-'.$col->col_xs}} pull-right">

                                <div>
                                        @foreach(\App\Models\Module::where('page',$page->title)->where('row',$section->sort)->where('col',$col->sort)->get() as $module)
                                            <div id="homeSection{{$module->row .$module->col . $module->sort}}" class="section-style">
                                                @php $typeModule=explode(',',$module->module_id);    @endphp
                                                @switch($typeModule[0])
                                                    @case('banner')
                                                    @if(\App\Models\Banner::where('id',$typeModule[1])->first())
                                                        <livewire:front.module.banner :banner="$typeModule[1]">
                                                            @endif
                                                            @break
                                                            @case('slider')
                                                            @php  $type=$typeModule[1].','.$section->sort.$col->sort.$module->sort;  @endphp
                                                            @if(\App\Models\Slider::where('id',$typeModule[1])->first())
                                                                <livewire:front.module.slider :slide="$type">
                                                                    @endif
                                                                    @break
                                                                    @case('carsoul')
                                                                    @php  $type=$typeModule[1] @endphp

                                                                    @if(\App\Models\Carsoul::where('id',$type)->first())
                                                                        <livewire:front.module.carsoul :carsoul="$type">
                                                                            @endisset

                                                                            @break
                                                                            @case('tab')
                                                                            @php  $type=$typeModule[1] @endphp

                                                                            @if(\App\Models\Tab::where('id',$type)->first())
                                                                                <livewire:front.module.tab :tab="$type">
                                                                                    @endisset

                                                                                    @break


                                                                                    @case('special')
                                                                                    @php  $type=$typeModule[1] @endphp
                                                                                    @if(\App\Models\Proposal::where('id',$type)->first())
                                                                                        <livewire:front.module.spesial :spesial="$type">
                                                                                            @endif
                                                                                            @break
                                                                                            @case('html')
                                                                                            @php  $type=$typeModule[1] @endphp
                                                                                            @if(\App\Models\Html::where('id',$type)->first())
                                                                                                <livewire:front.module.html :html="$type">
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
                                                                                                                    @case('AllCategory')
                                                                                                                    <livewire:front.module.category>
                                                                                                        @break
                                                                                                                        @case('InstantOffer')
                                                                                                                        <livewire:front.module.instant-offer>
                                                                                                            @break



                                                                                                        @endswitch
                                            </div>

                                        @endforeach
                                    </div>
                                </div>

                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
</div>
@push('moduleCss')
    <style>
        @foreach($sectionclass as $value)
            {{$value}}
        @endforeach
    </style>
@endpush


