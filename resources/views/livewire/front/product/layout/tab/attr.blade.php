<div>
    <div class="tab-pane fade rtl"
         id="tab-attr" role="tabpanel"
         aria-labelledby="pills-attr-tab">
        @foreach($attributeGroup as $group)
            @if($this->hasAttr($group->id))
            <article>
                    <h3 class="params-title">{{$group->title}}</h3>
                    <ul class="params-list">
                        @foreach(\App\Models\Attribute::orderBy('sort_order','ASC')->where('group',$group->id)->where('category_id',$product->category)->get() as $value)
                            @if($this->hasValueAttribute($value->id))
                                <li class="params-list-item">
                                    <div class="params-list-key">
                                        <span class="block">{{$value->title}}</span>
                                    </div>
                                    <div class="params-list-value">
                                        <span class="block">
                                            {{\App\Models\ProductProperty::where('product_id',$product->id)->where('title',$value->id)->pluck('description')->first()}}  {{$value->value}}
                                        </span>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </article>
            @endif
        @endforeach
    </div>
</div>
