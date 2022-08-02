<div>
    <nav class="sidebar">
        <div class="nav-header">
            <!--              <img class="pic-header" src="images/header-pic.jpg" alt="">-->
            <div class="header-cover"></div>
            <div class="logo-wrap">
                <a class="logo-icon" href="{{route('Home')}}"><img alt="logo-icon" src="/storage/{{$options->logo}}" width="40"></a>
            </div>
        </div>
        <ul class="nav-categories ul-base">
            @foreach($oneLeveles as $cat)

                <li>
                    @if(\App\Models\Category::where('status',1)->where('parent',$cat->id)->first())
                    <a href="{{route('ProductCategory',$cat->slug)}}" class="collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$cat->id}}" aria-expanded="false" aria-controls="collapseOne">
                     <i class="mdi mdi-chevron-down"></i>
                        {{$cat->title}}
                    </a>
                    @else
                    <a href="{{route('ProductCategory',$cat->slug)}}" >{{$cat->title}}  </a>
                    @endif
                    <div id="collapse{{$cat->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                        <ul>
                            @foreach(\App\Models\Category::where('status',1)->where('parent',$cat->id)->get() as $secondLevel)
                                @if(\App\Models\Category::where('status',1)->where('parent',$secondLevel->id)->first())

                                    <li class="has-sub">

                                        <a href="{{route('ProductCategory',$secondLevel->slug)}}" class="category-level-2">{{$secondLevel->title}}</a>
                                @else
                                    <li >
                                        <a href="{{route('ProductCategory',$secondLevel->slug)}}" >{{$secondLevel->title}}</a>
                                        @endif

                                        <ul>
                                            @foreach(\App\Models\Category::where('status',1)->where('parent',$secondLevel->id)->get() as $theirdLevel)


                                                <li><a href="{{route('ProductCategory',$theirdLevel->slug)}}" class="category-level-3">{{$theirdLevel->title}}</a></li>
                                            @endforeach

                                        </ul>
                                    </li>
                                    @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
            @foreach($menus as $menu)
                <li>
                    @if($this->linkPage($menu->link)[0] == 0)

                        <a href="{{route('FrontBlog')}}" >
                            {{$menu->title}}
                        </a>
                    @elseif(isset($this->linkPage($menu->link)[1]))
                        <a href="{{route($this->linkPage($menu->link)[0],$this->linkPage($menu->link)[1])}}" >

                            {{$menu->title}}
                        </a>
                    @else
                        <a href="{{route($this->linkPage($menu->link)[0])}}">
                            {{$menu->title}}
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </nav>
</div>
