<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Option;
use App\Models\Product;
use App\Models\productOption;
use App\Models\SiteOption;
use App\Models\Warranty;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{
    use WithFileUploads;

    public Product $product;
    public $category, $dd;
    public $val = false, $valoption = false, $valp;
    public $showcategories = [];
    public $showproducts = [];
    public $showOptionUl = [], $option_required = [], $option_count = [], $option_nullable, $option_color = [], $weight_prefix = [], $option_weight = [], $option_price = [], $price_prefix = [], $option_quantity = [], $option_anbar = [], $options, $option_type, $option_value = [], $options_option;
    public $inputAttribues = [], $attribue_name = [];
    public $inputdownload = [], $download_file, $download_title;
    public $inputImage = [], $product_img = [];
    public $inputproperty = [], $property_name = [], $property_text = [], $property_des = [];
    public $inputNaghdes = [], $naghd_description = [], $naghd_title = [];
    public $type;
    public $optionType1 = [];
    public $image;
    public $product_id;
    public $i = 0, $j = 0, $k = 0, $l = 0, $t1 = 0, $t2 = 1, $t3 = 1, $e = 1, $d = 1, $b = 1;
    public $result = null;
    protected $rules = [
        'product.title' => 'required|string|min:2|max:255',
        'product.slug' => 'required|string|min:2|max:255|unique:products,slug',
        'product.shipping' => 'required',
        'product.type' => 'required',
        'product.price' => 'required|integer',
        'product.related' => 'nullable',
        'product.anbar' => 'nullable',
        'product.manufacturer' => 'nullable',
        'product.description' => 'nullable|string|min:2',
        'product.quantity' => 'nullable|numeric|min:0',
        'product.category' => 'required',
        'product.minimum' => 'nullable|numeric|min:0',
        'product.location' => 'nullable',
        'product.sell' => 'nullable|numeric|min:0|max:100',
        'product.warrenty' => 'nullable',
        'product.Release_date' => 'nullable',
        'product.weight_class_id' => 'nullable',
        'product.weight' => 'nullable|numeric|min:0',
        'product.status' => 'nullable',
        'product.meta_title' => 'nullable|string|min:2',
        'product.meta_description' => 'nullable|string|min:3',
        'product.meta_keyword' => 'nullable|string|min:3',
        'product.naghd' => 'nullable|string|min:3',
        'image' => 'required|file|max:800|mimes:jpg,bmp,png,jpeg,gif,webp',
    ];

    public function mount()
    {
        $license = SiteOption::first()->license;
        $server = $_SERVER["SERVER_NAME"];
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, "https://panel.green-code.ir/verifyLicense.php");
        curl_setopt($c, CURLOPT_TIMEOUT, 30);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        $postfields = 'svr=' . $server . '&lic=' . $license;
        curl_setopt($c, CURLOPT_POSTFIELDS, $postfields);
        $check = curl_exec($c);
        if ($check == "verified") {
        } else {
            $this->result = $check;
            return view('livewire.admin.product.add-product');
        }
        $this->product = new Product();
        $this->product->weight = 0;
        $this->product->anbar = 1;
        $this->product->quantity = 0;
        $this->product->price = 0;
        $this->product->weight_class_id = 'kgram';
        $this->product->status = 1;
        $this->product->minimum = 1;
    }

    public function AddAttribute($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputAttribues, $i);
    }

    public function AddNaghd($d)
    {
        $d = $d + 1;
        $this->d = $d;
        array_push($this->inputNaghdes, $d);
    }

    public function removeNaghd($d)
    {
        unset($this->inputNaghdes[$d]);
        unset($this->naghd_description[$d]);
        unset($this->naghd_title[$d]);

    }

    public function AddProperty($e)
    {
        $e = $e + 1;
        $this->e = $e;
        array_push($this->inputproperty, $e);
    }

    public function AddImage($j)
    {
        $j = $j + 1;
        $this->j = $j;
        array_push($this->inputImage, $j);
    }

    public function AddDownload($l)
    {
        $l = $l + 1;
        $this->l = $l;
        array_push($this->inputdownload, $l);
    }

    public function addOptionUl()
    {
        $this->validate([
            "option_type" => 'required',
            "options" => 'required',
        ], [
            'option_type.required' => 'انتخاب نوع گزینه اجباری است.',
            'options.required' => 'انتخاب عنوان گزینه اجباری است.',
        ]);
        if ($this->options !== '') {
            if (!isset($this->option_type)) {
                $this->option_type = 1;
            }
            array_push($this->showOptionUl, ($this->options . ',' . $this->option_type));
            $this->options = '';
            $this->option_type = '';

        }


    }

    public function removeOption($id)
    {
        unset($this->showOptionUl[$id]);
        unset($this->optionType1[$id]);
        if (isset($this->option_value[$id])) {
            foreach ($this->option_value[$id] as $key => $value) {

                unset($this->option_value[$id][$key]);
                if (isset($this->option_color[$id][$key])) {
                    unset($this->option_color[$id][$key]);
                }
                if (isset($this->option_quantity[$id][$key])) {
                    unset($this->option_quantity[$id][$key]);
                }
                if (isset($this->option_anbar[$id][$key])) {
                    unset($this->option_anbar[$id][$key]);
                }
                if (isset($this->option_price[$id][$key])) {
                    unset($this->option_price[$id][$key]);
                    unset($this->price_prefix[$id][$key]);
                }
                if (isset($this->option_weight[$id][$key])) {
                    unset($this->option_weight[$id][$key]);
                    unset($this->weight_prefix[$id][$key]);
                }


            }
        }


    }

    public function AddOptionType1($t1, $key)
    {
        $t1 = $t1 + 1;
        $this->t1 = $t1;
        $this->optionType1[$key][$t1] = $t1;


    }

    public function removeoptionType1($key, $t1)
    {

        unset($this->optionType1[$key][$t1]);
        unset($this->option_value[$key][$t1]);
        if (isset($this->option_color[$key][$t1])) {
            unset($this->option_color[$key][$t1]);
        }
        if (isset($this->option_quantity[$key][$t1])) {
            unset($this->option_quantity[$key][$t1]);
        }
        if (isset($this->option_anbar[$key][$t1])) {
            unset($this->option_anbar[$key][$t1]);
        }
        if (isset($this->option_price[$key][$t1])) {
            unset($this->option_price[$key][$t1]);
            unset($this->price_prefix[$key][$t1]);
        }
        if (isset($this->option_weight[$key][$t1])) {
            unset($this->option_weight[$key][$t1]);
            unset($this->weight_prefix[$key][$t1]);
        }


    }

    public function removeImage($j)
    {
        unset($this->inputImage[$j]);
        unset($this->product_img[$j]);

    }

    public function removeAttribues($i)
    {

        unset($this->inputAttribues[$i]);
        unset($this->attribue_name[$i]);

    }

    public function removeProperty($e)
    {
        unset($this->inputproperty[$e]);
        unset($this->property_name[$e]);
        unset($this->property_text[$e]);


    }

    public function removeDownload($l)
    {
        unset($this->inputdownload[$l]);
        unset($this->download_title[$l]);
        unset($this->download_file[$l]);

    }

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function saveInfo()
    {

        if (Gate::allows('edit_product')) {
            $productAttr = \App\Models\Attribute::where('category_id', $this->product->category)->get();
            foreach ($productAttr as $value) {
                array_push($this->property_name, $value->id);
            }
            if ($this->property_text) {
                foreach ($this->property_text as $key => $value) {
                    if (isset($this->property_text[$key])) {
                        $text = $this->property_text[$key];
                    } else {
                        $text = '';
                    }
                    $properties[] = [
                        'title' => $this->property_name[$key],
                        'description' => $text,
                    ];

                }

            }
            if ($this->inputAttribues) {
                foreach ($this->attribue_name as $key => $value) {
                    $this->validate([
                        "attribue_name.$key" => 'nullable',
                    ], [
                        'attribue_name.*.nullable' => 'عنوان خصوصیات اجباری است',
                    ]);
                    $description = $this->attribue_name[$key];
                    $attributeess[] = [
                        'attribue_description' => $description,
                    ];

                }

            }
            $naghdes = [];
            if ($this->naghd_title) {
                foreach ($this->naghd_title as $key => $value) {
                    $this->validate([
                        "naghd_title.$key" => 'nullable',
                    ], [
                        'naghd_title.*.nullable' => 'عنوان نقد و بررسی اجباری است',
                    ]);
                    $naghdes[] = [
                        'title' => $this->naghd_title[$key],
                        'description' => $this->naghd_description[$key],
                    ];

                }

            }
            $properties = [];
            if ($this->property_name) {
                foreach ($this->property_name as $key => $value) {
                    if (isset($this->property_text[$key])) {
                        $text = $this->property_text[$key];
                        $properties[] = [
                            'title' => $this->property_name[$key],
                            'description' => $text,
                        ];
                    }
                }

            }
            //download save
            $downloads = [];
            if ($this->download_title) {
                foreach ($this->download_title as $key => $value) {
                    $this->validate([
                        "download_title.$key" => 'nullable',
                        "download_file.$key" => 'required|mimes:zip|max:5000',
                    ], [
                        'download_title.*.nullable' => 'عنوان دانلود اجباری است',
                        'download_file.*.nullable' => 'فایل دانلود اجباری است',
                        'download_file.*.mimes' => 'پسوند فایل باید  zip باشد.',
                    ]);
                    $filename = Storage::disk('private')->put('file', $this->download_file[$key]);
                    $file_name = str_replace('file/', '', $filename);
                    $downloads[] = [
                        'file' => "$file_name",
                        'title' => $this->download_title[$key],
                    ];


                }
            }
            //images save
            $images = [];
            if ($this->product_img) {
                foreach ($this->product_img as $key => $value) {
                    $this->validate([
                        "product_img.$key" => 'nullable|image|mimes:jpg,bmp,png,jpeg,gif,webp,svg',
                    ], [
                        'uploadImage.*.max' => 'حداکثر حجم تصویر باید 800 کیلو بایت باشد.',
                        'uploadImage.*.mimes' => 'پسوند تصویر بایدjpg,bmp,png,jpeg,gif,webp,svg باشد ',
                        'uploadImage.*.max' => 'حداکثر سایز تصویر باید 800 کیلو بایت باشد. ',
                    ]);
                    $directory = "photos/products";
                    $name1 = $this->product_img[$key]->getClientOriginalName();
                    $this->product_img[$key]->storeAs($directory, $name1);
                    $images[] = [
                        'img' => "$directory/$name1",
                    ];


                }
            }
            if ($this->image) {
                $this->product->image = $this->uploadImage()[0];
                $this->product->thumbnail = $this->uploadImage()[1];
            }
            $comma_separated = implode(",", $this->showproducts);
            $this->product->related = $comma_separated;
            $this->validate();
            $this->product->save();
            foreach ($this->showOptionUl as $keyoption => $valueoption) {

                if (isset($this->option_required[$keyoption])) {
                    $required = $this->option_required[$keyoption];
                } else {
                    $required = 0;
                }
                $string = explode(',', $valueoption);
                $typeoption = $string[1];
                $option = $string[0];
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
                            if (isset($this->price_prefix[$keyoption][$key])) {
                                $options->price_prefix = $this->price_prefix[$keyoption][$key];
                            } else {
                                $options->price_prefix = '1';
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

            }
            if ($this->inputAttribues) {
                $this->product->productAtts()->createMany($attributeess);
            }
            if ($this->naghd_title) {
                $this->product->productNaghds()->createMany($naghdes);
            }
            if ($this->property_name) {
                $this->product->productProperties()->createMany($properties);
            }
            if ($this->download_title) {
                $this->product->productDownloads()->createMany($downloads);
            }
            if ($this->product_img) {

                $this->product->productImages()->createMany($images);
            }
            $msg = 'محصول ذخیره شد';
            return redirect(route('Products'))->with('sucsess', $msg);

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function uploadImage()
    {

        $directory = "photos/products";
        $thumb = storage_path('app/public/photos/products/thumbnail_') . $this->image->getClientOriginalName();
        $name = $this->image->getClientOriginalName();
        $this->image->storeAs($directory, $name);
        $img = Image::make($this->image->getRealPath())->resize(500, 500)->save();
        Image::make($this->image->getRealPath())->resize(250, 250)->save($thumb);
        $image = ["$directory/$name", "$directory/thumbnail_$name"];
        return ($image);
    }

    public function render()
    {
        $manufacturers = Manufacturer::get();
        $categories = Category::where('parent', 0)->
        orWhere('parent', NULL)->
        get();
        $products = Product::get();
        $properties = Attribute::get();
        $optionType = $this->optionType1;
        $garranties = Warranty::where('status', 1)->get();
        return view('livewire.admin.product.add-product', compact('manufacturers', 'garranties', 'properties', 'optionType', 'categories', 'products'));
    }
}
