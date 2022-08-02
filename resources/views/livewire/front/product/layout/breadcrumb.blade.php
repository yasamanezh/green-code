<div>
    <div class="col-12">
        <div class="breadcrumb-container mt-2">
            <ul class="js-breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                </li>
                @if($child)
                    <li class="breadcrumb-item">
                        <a href="{{route('ProductCategory',$child->slug)}}"
                           class="breadcrumb-link">{{$child->title}}</a>
                    </li>
                @endif
                @if($sub)
                    <li class="breadcrumb-item">
                        <a href="{{route('ProductCategory',$sub->slug)}}" class="breadcrumb-link">{{$sub->title}}</a>
                    </li>
                @endif
                @isset($category)
                    <li class="breadcrumb-item">
                        <a href="{{route('ProductCategory',$category->slug)}}"
                           class="breadcrumb-link">{{$category->title}}</a>
                    </li>
                @endisset
                <li class="breadcrumb-item">
                    <a href="{{route('SingleProduct',$product->slug)}}"
                       class="breadcrumb-link active-breadcrumb">{{$product->title}}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
