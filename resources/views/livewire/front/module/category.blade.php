<div class="promotion-categories-container">
    <span class="promotion-categories-title">بیش از {{count($products)}} کالا در دسته‌بندی‌های مختلف</span>
    <div class="category-container">
        <div class="promotion-categories">
            @foreach($categories as $category)
            <a href="{{route('ProductCategory',$category->slug)}}" class="promotion-category">
                <img src="/storage/{{$category->img}}" alt="{{$category->title}}" >

                <div class="promotion-category-name">{{$category->title}}</div>
                <div class="promotion-category-quantity">{{$this->productCount($category->id)}} کالا</div>
            </a>
            @endforeach
        </div>
    </div>
</div>
