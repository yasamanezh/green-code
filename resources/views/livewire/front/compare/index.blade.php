<div class="container-main">
    <div class="col-12">
        <div class="breadcrumb-container mt-2">
            <ul class="js-breadcrumb ">
                <li class="breadcrumb-item">
                    <a href="{{route('Home')}}" class="breadcrumb-link">خانه</a>
                </li>
                @if($child)
                    <li class="breadcrumb-item">
                        <a  href="{{route('ProductCategory',$child->slug)}}" class="breadcrumb-link">{{$child->title}}</a>
                    </li>
                @endif
                @if($sub)
                    <li class="breadcrumb-item">
                        <a href="{{route('ProductCategory',$sub->slug)}}" class="breadcrumb-link">{{$sub->title}}</a>
                    </li>
                @endif
                <li class="breadcrumb-item">
                    <a href="{{route('ProductCategory',$category->slug)}}" class="breadcrumb-link">{{$category->title}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('SingleProduct',$firstProduct->slug)}}" class="breadcrumb-link active-breadcrumb">{{$firstProduct->title}}</a>
                </li>
            </ul>
        </div>
        <div class="p_comparison">
            <div class="p_comparison-overflow">
                <ul class="compare-list compare-list--header">
                    <div class="d-inline-block">
                        <li class="is-header">
                            <div class="compare-list-value js-compare-product">
                                <div class="compare-add compare-img">
                                    <a  class="compare-placement">
                                        <i class="mdi mdi-cart-plus"></i>مشخصات
                                    </a>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="d-inline-block">
                        @foreach($showproducts as $key=>$value)
                            @php $pro=\App\Models\Product::find($value);   @endphp
                            <li class="is-header" style="width:246px">
                                <div class="compare-list-value js-compare-product">
                                    <div class="compare-img">
                                        <div class="compare-content-holder">
                                            <button class="btn compare-btn-remove js-remove-compare-product" type="submit">
                                                <i class="mdi mdi-close" wire:click.prevent="remove({{$key}})"></i>
                                            </button>
                                            <a href="{{route('SingleProduct',$pro->slug)}}" class="js-compare-product-images">
                                                <img class="img-fluid" src="/storage/{{$pro->image}}" alt="{{$pro->title}}">
                                            </a>
                                            <span class="title">{{$pro->title}}</span>
                                            <div class="price">
                                                <div class="price-value">
                                                    @if($pro->price ==0)
                                                        {{number_format($pro->price)}}  تومان
                                                    @else
                                                        @if($this->priceProdct($pro->id ) == 1)
                                                            <span class="text-center font-size-14">{{number_format($pro->price)}} </span><span class="toman">تومان</span>
                                                        @else
                                                            <s class=" font-size-12">{{number_format($pro->price)}} تومان</s>
                                                            <br>

                                                            <span class="new-price-discount ">%{{(1-$this->priceProdct($pro->id ))*100}}</span>
                                                            <span class="font-size-14"> {{number_format($this->priceProdct($pro->id )*$pro->price)}}</span>
                                                            <span class="toman">تومان</span>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </div>
                    @if(count($products) < 4 )
                        <div class="d-inline-block position-relative">
                            <li class="is-header">
                                <button wire:ignore class="btn btn-outline-danger" data-toggle="modal"   wire:click.prevent="Add()">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    افزودن به مقایسه
                                </button>

                            </li>
                        </div>


                    @endif
                </ul>


                <ul class="compare-quick-list ">
                    @foreach($attribueGroup as $key=>$value)
                        <h3 class="params-title">{{$value->title}}</h3>
                        @foreach(\App\Models\Attribute::where('group',$value->id)->where('category_id',$category->id)->get() as $attribute )
                            <li class="params-list-item">
                                <div class="d-inline-block px-0">
                                    <div class="compare-list-desc compaire">
                                        <h3 class="block params-headline ">{{$attribute->title}}
                                            @if($attribute->value && !empty($attribute->value))
                                                ({{$attribute->value}})
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                                @foreach($products as $prod)
                                    <div class="d-inline-block px-0  " >
                                        <div class="compare-list-value">
                                                <span class="block  ">
                                                    {{\App\Models\ProductProperty::where('product_id',$prod)->where('title',$attribute->id)->pluck('description')->first()}}
                                                </span>
                                        </div>
                                    </div>
                                @endforeach
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div  wire:ignore.self  class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content" style="width: 80%">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        انتخاب کالا برای مقایسه
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <div class="container">
                        <div class="col-sm-12 pull-right form-group">
                            <input wire:model="search" class="form-control"><br>
                        </div>
                        <div >
                            @foreach($categoryProduct as $value)
                                <div  class=" col-sm-6 col-md-6 col-lg-4 border-light pull-right"  >
                                    <div class="compare-list-value js-compare-product compaire-modal">
                                        <div class="compare-img">
                                            <div class="compare-content-holder">
                                                <a class="js-compare-product-images">
                                                    <img class="img-fluid" src="/storage/{{$value->image}}" alt="{{$value->title}}">
                                                </a><br>
                                                <span class="title">{{$value->title}}</span>
                                                <div class="price height-50">
                                                    <div class="price-value">
                                                        @if($value->price ==0)
                                                            {{number_format($value->price)}}  تومان
                                                        @else
                                                            @if($this->priceProdct($value->id ) == 1)
                                                                <span class="text-center font-size-14">{{number_format($value->price)}} </span><span class="toman">تومان</span>
                                                            @else
                                                                <s class=" font-size-12">{{number_format($value->price)}} تومان</s>
                                                                <br>

                                                                <span class="new-price-discount ">%{{(1-$this->priceProdct($value->id ))*100}}</span>
                                                                <span class="font-size-14"> {{number_format($this->priceProdct($value->id )*$value->price)}}</span>
                                                                <span class="toman">تومان</span>
                                                            @endif
                                                        @endif
                                                        </div>
                                                </div><br>
                                                <button class="btn btn-outline-primary mb-2"  wire:click="addCompare({{$value->id}})">افزودن به مقایسه </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <br>
                        </div>
                    </div>
                    @if($counMore > $pageNumber)
                        <button class="btn btn-outline-danger mt-2" wire:click.prevent="loadMore">مشاهده بیشتر</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('jsBeforMain')

    <script>
        $(document).ready(function () {

            window.addEventListener('show-form', event => {
                $('#exampleModalCenter').modal('show');
            })

            window.addEventListener('hide-form', event => {
                $('#exampleModalCenter').modal('hide');
            })

        });

    </script>
@endpush
