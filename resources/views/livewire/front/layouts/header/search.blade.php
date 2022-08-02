<div>
    <div class="search-header position-relative section-style">
        <div  wire:keydown.enter="search($event.target.value)">
            <input  type="text" wire:model.debance.1000="search" class="search-input" placeholder="جستجو …">
            <a  type="submit" class="button-search"
                href="@if(!empty($search) ) {{route('Search',$search)}} @endif">
                <img src="{{asset('/assets/images/search.png')}}">
            </a>
        </div>
            <div class="search-result" wire:ignore.self style="height: 400px;overflow-y: scroll">
                <ul class="categories">
                    @if($categories )
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{route('ProductCategory',$cat->slug)}}"><i class="mdi mdi-clock-outline"></i>
                                {{$cat->title}}
                                <button class="btn btn-light btn-remove-search" type="submit">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                            </a>
                        </li>
                    @endforeach
                    @endif
                </ul>
                <ul class="search-result-list mb-0" >
                    @if($products)
                    @foreach($products as $product)
                        <li>
                            <a href="{{route('SingleProduct',$product->slug)}}"><i class="mdi mdi-clock-outline"></i>
                                {{$product->title}}
                                <button class="btn btn-light btn-remove-search" type="submit">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                            </a>
                        </li>
                    @endforeach
                     @endif
                </ul>
            </div>
    </div>

</div>
