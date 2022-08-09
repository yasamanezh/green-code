<div>

    <div class="container-xxl position-relative p-0" style="margin-top: -400px">

        <div class="container-xxl py-5 bg-primary hero-header mb-5">
            <div class="container my-5 py-2 px-lg-5">
                <div class="row g-5 py-2">
                    <div class="col-lg-6 text-center text-lg-start">
                        <img class="img-fluid" src="http://green-code.test/storage/photos/2/hero.png" alt="">
                    </div>

                    <div class="col-lg-6 text-center text-lg-start  mt-5" style="margin-top: 150px !important;">
                        <h1 class="text-white animated zoomIn text-center ">پکیج ها</h1>
                        <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Home')}}">خانه</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">پکیج ها</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl">
        <div class="container-fluid px-lg-5">
            <div class="row g-5">

                <div class="col-lg-12">
                    <!-- Portfolio Start -->
                    <div class="container-xxl " style="direction: ltr">
                            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                                <h6 class="position-relative d-inline text-primary ps-4">
                                    <span class="mr-2">پکیج ها</span>
                                </h6>
                                <h2 class="mt-2">  پکیج های تجاری گرینکد</h2>
                            </div>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @foreach($categories as $category)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link   {{$loop->first ? ' active' : ''}}"
                                            id="pills-home-tab{{$category->id}}" data-bs-toggle="pill"
                                            data-bs-target="#tab{{$category->id}}" type="button" role="tab"
                                            aria-controls="tab{{$category->id}}"
                                            aria-selected="{{$loop->first ? 'true' : 'false'}}">{{$category->title}}</button>
                                </li>
                            @endforeach


                        </ul>
                        <div class="tab-content" id="pills-tabContent rtl">
                            @foreach($categories as $category)
                                <div class="tab-pane fade  {{$loop->first ? 'show active' : ''}} rtl"
                                     id="tab{{$category->id}}" role="tabpanel"
                                     aria-labelledby="pills-home-tab{{$category->id}}">
                                    <div class="row g-4">
                                    @foreach(App\Models\Product::where('status',1)->where('category',$category->id)->get() as $product)
                                          <div class="col-lg-3 col-md-4 col-sm-6 {{$product->category}} ">
                                                    <div class="box">
                                                        <h1>{{$product->title}}</h1>
                                                        @foreach(App\Models\Attribute::orderBy('sort_order','Asc')->where('category_id',$product->category)->get() as $attr)

                                                            <span>{{$attr->title}}</span>
                                                            @if(App\Models\ProductProperty::where('title',$attr->id)->where('product_id',$product->id)->pluck('description')->first() ==1)
                                                                +
                                                            @else
                                                                -
                                                            @endif

                                                        @endforeach
                                                        <br>
                                                        <a href="{{route('SingleProduct',$product->slug)}}" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">مشاهده بیشتر</a>
                                                    </div>

                                                </div>
                                  @endforeach
                                    </div>

                                </div>
                            @endforeach

                        </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
