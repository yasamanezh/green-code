<?php

namespace App\Http\Livewire\Admin\Product;


use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\ProductAtt;
use App\Models\ProductDownload;
use App\Models\Option;
use App\Models\productOption;
use App\Models\ProductProperty;
use App\Models\Warranty;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Product;
use App\Models\Attribute;
use Livewire\WithFileUploads;
use Image;

class EditProduct extends Component
{

    use WithFileUploads;


    public $category;
    public Product $product;
    public $image;
    public $val=false;
    public $valoption=false;
    public $valp=false;

    public $showproducts=[];
    public $showOptionUl=[],$option_count,$option_required=[],$option_color, $inputoptionul = [],$weight_prefix,$option_weight,$option_price,$price_prefix,$option_quantity,$option_anbar,$options,$option_type,$option_value=[],$options_option;
    public $inputAttribues = [], $attribue_name=[];
    public $inputdownload = [],$download_file_upload=[],$download_file=[],$download_title=[];
    public $inputImage = [],$product_img=[],$uploadImage=[];
    public $inputproperty=[],$property_name=[],$property_text=[];
    public $property_des=[];

    public $type,$imageupadate;
    public $optionType1=[];

    public $product_id;
    public $i=0,$j=0,$k=0,$l=0,$t1=1,$t2=1,$t3=1,$e=1,$d=1;
    public function mount()
    {
        $this->image=$this->product->image;

        $attrs=ProductAtt::where('product_id',$this->product->id)->get();
        foreach ($attrs as $attr){
            $i=$this->i;
            $i = $i + 1;
            array_push($this->inputAttribues ,$i);
            array_push($this->attribue_name ,$attr->attribue_description);


        }
        $Properties=ProductProperty::where('product_id',$this->product->id)->get();
        foreach ($Properties as $Property){
            $this->property_text[$Property->title]=[];
            $e=$this->e;
            $e = $e + 1;
            array_push($this->inputproperty ,$e);
            $this->property_text[$Property->title]=$Property->description;

        }

        $downloads=ProductDownload::where('product_id',$this->product->id)->get();
        if($downloads){
            foreach ($downloads as $value){
                $l=$this->l;
                $l = $l + 1;
                array_push($this->inputdownload ,$l);
                array_push($this->download_file ,$value->file);
                array_push($this->download_title ,$value->title);
            }
        }
         $options=productOption::where('product_id',$this->product->id)->get();

        if($options){
            foreach ($options as $key=>$value){
                if($this->options !==''){
                    if($value->type=='select'){
                        $type='select';
                        $this->type='select';
                    }elseif($value->type=='radio'){
                        $type='radio';
                        $this->type='radio';
                    }elseif($value->type=='color'){
                        $type='color';
                        $this->type='color';
                    }else{
                        $type='input';
                        $this->type='input';
                    }
                    array_push($this->showOptionUl,($value->option.','.$type));
                    array_push($this->option_required,$value->required);
                    $optionsvalue=Option::where('product_id',$this->product->id)->where('option',$value->option)->get();
                    foreach ($optionsvalue as $key1=>$value1){
                        $t1=$this->t1;
                        $this->optionType1[$key][$key1]=$key1;
                        $this->option_value[$key][$key1]=$value1->value;
                        $this->option_color[$key][$key1]=$value1->color;
                        $this->option_quantity[$key][$key1]=$value1->count;
                        $this->option_weight[$key][$key1]=$value1->weight;
                        $this->option_price[$key][$key1]=$value1->price;
                        $this->option_anbar[$key][$key1]=$value1->anbar;
                        $this->price_prefix[$key][$key1]=$value1->price_prefix ;
                        $this->weight_prefix[$key][$key1]=$value1->weight_prefix ;
                        $t1 = $t1 + 1;
                    }

                }

            }
        }


        if($this->product->related){
            $related=explode(',',$this->product->related );
            foreach ($related as $value){
                array_push($this->showproducts,$value);
            }


        }

    }
    public function AddAttribute($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputAttribues ,$i);
    }

    public function addOptionUl(){
        $this->validate([
            "option_type" => 'required',
            "options" => 'required',
        ], [
            'option_type.required' => 'انتخاب نوع گزینه اجباری است.',
            'options.required' => 'انتخاب عنوان گزینه اجباری است.',

        ]);
        if($this->options !==''){
            if(!isset($this->option_type)){
                $this->option_type=1;
            }
            array_push($this->showOptionUl,($this->options.','.$this->option_type));
            $this->options='';
            $this->option_type='';

        }


    }
    public function  removeOption($id)
    {
        unset($this->showOptionUl[$id]);
        unset($this->optionType1[$id]);
        if(isset($this->option_value[$id])){

            foreach ($this->option_value[$id] as $key=>$value){

                unset($this->option_value[$id][$key]);

                if(isset($this->option_color[$id][$key])){
                    unset($this->option_color[$id][$key]);
                }
                if(isset($this->option_quantity[$id][$key])){
                    unset($this->option_quantity[$id][$key]);
                }
                if(isset($this->option_anbar[$id][$key])){
                    unset($this->option_anbar[$id][$key]);
                }
                if(isset($this->option_price[$id][$key])){
                    unset($this->option_price[$id][$key]);

                    unset($this->price_prefix[$id][$key]);
                }
                if(isset($this->option_weight[$id][$key])){
                    unset($this->option_weight[$id][$key]);
                    unset($this->weight_prefix[$id][$key]);
                }
            }

        }
    }
    public function AddDownload($l)
    {
        $l = $l + 1;
        $this->l = $l;
        array_push($this->inputdownload,$l);
    }
    public function AddOptionType1($t1,$key)
    {
        $t1 = $t1 + 1;
        $this->t1 = $t1;
        $this->optionType1[$key][$t1]=$t1;



    }
    public function removeoptionType1($key,$t1)
    {

        unset($this->optionType1[$key][$t1]);
        unset($this->option_value[$key][$t1]);
        if(isset($this->option_color[$key][$t1])){
            unset($this->option_color[$key][$t1]);
        }
        if(isset($this->option_quantity[$key][$t1])){
            unset($this->option_quantity[$key][$t1]);
        }
        if(isset($this->option_anbar[$key][$t1])){
            unset($this->option_anbar[$key][$t1]);
        }
        if(isset($this->option_price[$key][$t1])){
            unset($this->option_price[$key][$t1]);

            unset($this->price_prefix[$key][$t1]);
        }
        if(isset($this->option_weight[$key][$t1])){
            unset($this->option_weight[$key][$t1]);
            unset($this->weight_prefix[$key][$t1]);
        }


    }

    public function removeAttribues($i)
    {

        unset($this->inputAttribues[$i]);
        unset($this->attribue_name[$i]);

    }

    public function removeDownload($l)
    {
        unset($this->inputdownload[$l]);
        if(isset($this->download_file_upload[$l])){
            unset($this->download_file_upload[$l]);

        }elseif(isset($this->download_file)){
            unset($this->download_file[$l]);
            unset($this->download_file[$l]);
        }
        unset($this->download_title[$l]);
    }


    protected $rules = [
        'product.title' => 'required|string|min:2|max:255',
        'product.slug' => 'required',
        'product.price' => 'required|numeric|min:0',
        'product.related' => 'nullable',

        'product.manufacturer' => 'nullable',
        'product.description' => 'nullable|string|min:2',

        'product.category' => 'required',

        'product.sell' => 'nullable|numeric|min:0|max:100',
        'product.warrenty' => 'nullable',
        'product.Release_date' => 'nullable',

        'product.status' => 'nullable',
        'product.meta_title' => 'nullable|string|min:2',
        'product.meta_description' => 'nullable|string|min:3',
        'product.meta_keyword' => 'nullable|string|min:3',
        'product.naghd' => 'nullable|string|min:3',
    ];

    public function uploadImage(){

        $directory="photos/products";
        $thumb=storage_path('app/public/photos/products/thumbnail_').$this->imageupadate->getClientOriginalName();
        $oldThumb=storage_path().'/app/public/'.$this->product->thumbnail;

        $name=$this->imageupadate->getClientOriginalName();
        $oldImage=storage_path().'/app/public/'.$this->product->image;
        if(file_exists($oldThumb)){
            File::delete($oldThumb);
        }
        if(file_exists($oldImage)){
            File::delete($oldImage);
        }
        $this->imageupadate->storeAs($directory,$name);
        $img=Image::make($this->imageupadate->getRealPath())->resize(500, 500)->save();
        Image::make($this->imageupadate->getRealPath())->resize(250, 250)->save($thumb);
        $image=["$directory/$name","$directory/thumbnail_$name"];
        return($image);
    }


    public function saveInfo()
{

    if(Gate::allows('edit_product')){
        $this->validate([
            'product.slug' => ['required','string','min:2','max:255', Rule::unique('products','slug')->ignore($this->product->id)],
        ]);
        if(empty($this->product->sell) ){
           $this->product->sell=0;
        }

        $properties=[];
        $productAttr=\App\Models\Attribute::where('category_id',$this->product->category)->get();
        if($this->property_text){
            foreach ($productAttr as $key=>$value){
                if(isset($this->property_text[$value->id])){
                    $text=$this->property_text[$value->id];
                    $this->property_text;
                    $properties[]=[
                        'title'=>$value->id,
                        'description'=>$text,
                    ];
                }
            }
        }



        if($this->inputAttribues){

            foreach ($this->attribue_name as $key=>$value){
                $this->validate([

                    "attribue_name.$key" => 'required',
                ],[

                    'attribue_name.*.required' => 'عنوان خصوصیات اجباری است',
                ]);
                $description=$this->attribue_name[$key];
                $attributeess[]=[
                    'attribue_description'=>$description,
                ];

            }

        }

        //download save
        $downloads=[];
        if($this->inputdownload){
            foreach ($this->inputdownload as $key => $value) {

                if(isset($this->download_file_upload[$key] )){
                    $this->validate([
                        "download_title.$key" => 'required',
                        "download_file_upload.$key" => 'required|mimes:zip|max:5000',
                    ],[
                        'download_title.*.required' => 'عنوان دانلود اجباری است',
                        'download_file_upload.*.required' => 'فایل دانلود اجباری است',
                        'download_file_upload.*.mimes' => 'پسوند فایل باید zip باشد.',
                    ]);

                    $filename = Storage::disk('private')->put('file',$this->download_file_upload[$key]);
                    $file_name=str_replace('file/','', $filename);

                    $downloads[] = [

                        'file' => "$file_name",
                        'title' => $this->download_title[$key],

                    ];


                }else{
                    $this->validate([
                        "download_title.$key" => 'required',
                    ],[
                        'download_title.*.required' => 'عنوان دانلود اجباری است',

                    ]);
                    $downloads[]=[
                        'file'=>$this->download_file[$key],
                        'title'=>$this->download_title[$key],
                    ];
                }
            }

        }
        //images save
        $images = [];
        if ($this->inputImage) {
            foreach ($this->inputImage as $key => $value) {
                if(isset($this->uploadImage[$key])){
                    $this->validate([
                        "uploadImage.$key" => 'nullable|image|max:800|mimes:jpg,bmp,png,jpeg,gif,webp,svg',
                    ], [
                        'uploadImage.*.max' => 'حداکثر حجم تصویر باید 800 کیلو بایت باشد.',
                        'uploadImage.*.mimes' => 'پسوند تصویر بایدjpg,bmp,png,jpeg,gif,webp,svg باشد ',
                        'uploadImage.*.max' => 'حداکثر سایز تصویر باید 800 کیلو بایت باشد. ',
                    ]);

                    $directory = "photos/products";
                    $name1 = $this->uploadImage[$key]->getClientOriginalName();
                    $this->uploadImage[$key]->storeAs($directory, $name1);
                    $images[] = [
                        'img' => "$directory/$name1",
                    ];
                }elseif(isset($this->product_img[$key])){
                    $images[] = [
                        'img' => $this->product_img[$key],
                    ];
                }else{
                    $this->validate([
                        "uploadImage.$key" => 'nullable|image',
                    ], [
                        'uploadImage.*.nullable' => ' تصویر اجباری است',
                        'uploadImage.*.mimes' => 'فیلد تصویر باید یک تصویر باشد',
                    ]);
                }



            }
        }

        $comma_separated = implode(",", $this->showproducts);
        $this->product->related=$comma_separated;

        $this->validate();
        $attrpro=ProductAtt::where('product_id',$this->product->id)->get();
        foreach ($attrpro as $value){

            $value->delete();
        }


        $oldProperty=ProductProperty::where('product_id',$this->product->id)->get();
        foreach ($oldProperty as $value){

            $value->delete();
        }

        $oldownload=ProductDownload::where('product_id',$this->product->id)->get();
        foreach ($oldownload as $value){
            $value->delete();
        }

        $oldselect=productOption::where('product_id',$this->product->id)->get();
        foreach ($oldselect as $value){

            $value->delete();
        }
        $oldsoptions=Option::where('product_id',$this->product->id)->get();
        foreach ($oldsoptions as $value){

            $value->delete();
        }

        if(! isset($this->product->price)){
            $this->product->price= 0;
        }

        if(! isset($this->product->status)){
            $this->product->status=1;
        }

        if(isset($this->imageupadate)){
            $this->validate([
               'imageupadate'=>'file|max:800|mimes:jpg,bmp,png,jpeg,svg'
            ]);
            $this->product->image=$this->uploadImage()[0];
            $this->product->thumbnail=$this->uploadImage()[1];
        }
        $this->product->update();

        foreach ($this->showOptionUl as $keyoption => $valueoption) {
            if (isset($this->option_required[$keyoption])) {
                $required = $this->option_required[$keyoption];
            } else {
                $required = 0;
            }
            $string = explode(',', $valueoption);
            $typeoption = $string[1];
            $option = $string[0];
            if($typeoption != 'input'){
                if (isset($this->option_value[$keyoption])) {
                    $saveoption = new productOption();
                    $saveoption->product_id = $this->product->id;
                    $saveoption->type = $typeoption;
                    $saveoption->option = $option;
                    $saveoption->required = $required;
                    $saveoption->save();
                    foreach ($this->option_value[$keyoption] as $key => $value) {

                        $options = new Option();

                        $options->value = $this->option_value[$keyoption][$key];

                        $options->option = $option;
                        $options->product_id = $this->product->id;
                        if (isset($this->option_color[$keyoption][$key])) {

                            $options->color = $this->option_color[$keyoption][$key];
                        }
                        if (isset($this->option_quantity[$keyoption][$key])) {
                            $this->validate([

                                "option_quantity.$keyoption.$key" => 'numeric|min:0',
                            ], [
                                'option_quantity.*.*.numeric' => 'تعداد گزینه باید عدد باشد.',
                                'option_quantity.*.*.min:0' => 'حداقل تعداد گزینه باید صفر میباشد.',
                            ]);
                            $options->count = $this->option_quantity[$keyoption][$key];
                        }
                        if (isset($this->option_anbar[$keyoption][$key])) {
                            $options->anbar = $this->option_anbar[$keyoption][$key];
                        }
                        if (isset($this->option_price[$keyoption][$key])) {
                            $this->validate([

                                "option_price.$keyoption.$key" => 'numeric|min:0',
                            ], [
                                'option_price.*.*.numeric' => 'قیمت باید عدد باشد.',
                                'option_price.*.*.min:0' => 'حداقل قیمت صفر میباشد.',
                            ]);
                            $options->price = $this->option_price[$keyoption][$key];
                            if (!isset($this->price_prefix[$keyoption][$key])) {
                                $options->price_prefix= '1';
                            } else {
                                $options->price_prefix = $this->price_prefix[$keyoption][$key];
                            }

                        }
                        if (isset($this->option_weight[$keyoption][$key])) {
                            $this->validate([

                                "option_weight.$keyoption.$key" => 'numeric|min:0',
                            ], [
                                'option_weight.*.*.numeric' => 'وزن باید عدد باشد.',
                                'option_weight.*.*.min:0' => 'حداقل وزن صفر میباشد.',
                            ]);
                            $options->weight = $this->option_weight[$keyoption][$key];
                            if (!isset($this->weight_prefix[$keyoption][$key])) {
                                $options->weight_prefix = '1';
                            } else {
                                $options->weight_prefix = $this->weight_prefix[$keyoption][$key];
                            }

                        }
                        $options->save();


                    }

                }

            }else{
                $saveoption = new productOption();
                $saveoption->product_id = $this->product->id;
                $saveoption->type = $typeoption;
                $saveoption->option = $option;
                $saveoption->required = $required;
                $saveoption->save();


                $options = new Option();
                $options->value = $option;
                $options->option = $option;
                $options->product_id = $this->product->id;
                $options->save();
            }


        }

        if($this->inputAttribues){
            $this->product->productAtts()->createMany($attributeess);
        }


        if($this->property_text){

            $this->product->productProperties()->createMany($properties);

        }

        if($this->download_title){
            $this->product->productDownloads()->createMany($downloads);
        }


        $msg = 'محصول ذخیره شد';
        return redirect(route('Products'))->with('sucsess', $msg);

    }else{
        $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
    }

}
    public function render()
    {
        $manufacturers=Manufacturer::get();
        $categories=Category::where('parent',0)->
        orWhere('parent',NULL)->
        get();
        $products=Product::get();
        $properties=Attribute::get();
        $garranties=Warranty::get();
        return view('livewire.admin.product.edit-product',compact('manufacturers','properties','categories','products','garranties'));
    }
}
