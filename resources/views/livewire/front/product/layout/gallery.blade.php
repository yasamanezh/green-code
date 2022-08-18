<div>
    <div class="container-xxl position-relative p-0" style="margin-top: -400px">

        <div class="container-xxl py-5 bg-primary hero-header mb-5">
            <div class="container my-5 py-2 px-lg-5">
                <div class="row g-5 py-2">
                    <div class="col-lg-6 text-center text-lg-start">

                    </div>

                    <div class="col-lg-6 text-center text-lg-start  mt-5" style="margin-top: 150px !important;">
                        <h1 class="text-white animated zoomIn text-center ">{{$product->title}}</h1>
                        <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Packages')}}">خانه</a></li>
                                <li class="breadcrumb-item"><a class="text-white" href="{{route('Home')}}">پکیج ها</a></li>
                                <li class="breadcrumb-item text-white active" aria-current="page">{{$product->title}}</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
