<div>
    <div class="container-xxl position-relative p-0" style="margin-top: -100px">

        <div class="container-xxl py-5 mb-5">
            <div class="container my-5 py-2 px-lg-5 rtl">
                <div class="row g-5 py-2">
                    <div class="col-lg-12 text-center text-lg-start">
                        <section class="product-info">

                            <div class="product-attributes">

                                <div class="col-lg-6 col-xs-12 pull-right">
                                    <div class="product-headline">
                                    </div>

                                    <img class="img-fluid pull-right" src="/storage/{{$product->image}}" alt="{{$product->title}}">
                                   @if($product->demo)
                                    <a href="{{$product->demo}}" target="_blank">مشاهده دمو</a>
                                    @endif
                                </div>
                                <div class="col-lg-5 col-xs-12 pull-left" style="text-align: right">
                                    <div >
                                        <div >

                                            <div >
                                                @foreach($options as $option)
                                                    @if($option->required ==1)
                                                        <span style="color:red">  *  </span>
                                                    @endif
                                                    <span>انتخاب {{$option->option}}: </span>
                                                    @error("color.$option->id")
                                                    <span style="color: red"> {{$message}}  </span>
                                                    @enderror
                                                    @if($option->type=='select' || $option->type=='color'|| $option->type=='radio' )
                                                        <div  class="mt-2 mb-3">
                                                            <select class="form-control" wire:change='changeSelectPrice($event.target.value,{{$option->id}})' wire:model.defer="color.{{$option->id}}" wire:change="changePrie($event.target.value,{{$option->id}})">
                                                                <option value="">لطفا انتخاب کنید</option>
                                                                @foreach(\App\Models\Option::where('product_id',$this->product->id)->where('option',$option->option)->get() as $optionValue1)
                                                                    <option value="{{$optionValue1->value}}">{{$optionValue1->value}} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    @elseif($option->type=='input')
                                                        <form >
                                                            <input class="form-control"  wire:model.defer="color.{{$option->id}}" >
                                                        </form>
                                                    @endif
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>
                                    <div class="product-summary">
                                        <div class="product-seller-info">

                                            <div class="product-seller-row price">
                                <span class="product-seller-price-info price-value mb-3 mt-2">
                                    <span class="title"> قیمت:</span>
                                    <span class="amount">
                                        @if($product->price == 0)
                                            0 تومان
                                        @elseif($percent >=1)
                                            <s class=" font-size-12">{{$product->price}} تومان</s>
                                            <br>

                                            <span class="new-price-discount ">%{{$percent}}</span>
                                            <span class="font-size-14"> {{number_format($price*(1-($percent/100))+$optionPrices)}} </span>
                                            <span class="toman">تومان</span>
                                        @else
                                            <span class="text-center font-size-14">{{number_format($price+$optionPrices)}} </span><span class="toman">تومان</span>
                                        @endif

                                    </span>
                                </span>
                                            </div>
                                            <div class="parent-btn mt-2">
                                                <a  wire:click.prevent="addToCart({{$product->id}})" class="btn btn-secondary text-light rounded-pill py-2 px-4 ms-3">خرید و پرداخت</a>

                                            </div>
                                            @if($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach($errors->all() as $error)
                                                            <li>{{$error}}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
