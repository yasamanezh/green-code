<?php

namespace App\Http\Livewire\Admin\Filter;

use App\Models\Category;
use App\Models\Filter as FilterModels;
use App\Models\Log;
use App\Models\SiteOption;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Add extends Component
{
    public $filter;
    public $data, $title, $category_id, $status;
    public $search;
    public $count_data = 10;
    public $inputFilter = [], $filter_title, $filter_value = [], $i = 1;
    public $result = null;
    protected $queryString = ['search'];

    public function AddFilter($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputFilter, $i);
    }

    public function removeFilter($i)
    {

        unset($this->inputFilter[$i]);
        unset($this->filter_value[$i]);
        unset($this->filter_title);

    }

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
            return view('livewire.admin.filter.add');
        }
        $this->status = 0;
    }

    public function saveInfo()
    {
        if (Gate::allows('edit_filter')) {
            $this->validate([
                'title' => 'required|string|min:2|max:255',
                'filter_title' => 'required',
                'category_id' => 'required',
            ]);
            $attributesave = '';
            foreach ($this->filter_value as $key => $value) {
                if ($attributesave != '') {
                    $attributesave = $attributesave . ',' . $this->filter_value[$key];
                } else {
                    $attributesave = $this->filter_value[$key];
                }
            }
            if (!$attributesave) {
                $this->emit('toast', 'warning', 'لطفا برای فیلتر مورد نظر مقدار مشخص کنید.');
                return;
            }
            $filter = new FilterModels();
            $filter->status = $this->status;
            $filter->title = $this->title;
            $filter->attribute = $this->filter_title;
            $filter->category_id = $this->category_id;
            $filter->attribute_id = $attributesave;
            $filter->save();
            if ($filter) {
                Log::create([
                    'user_id' => auth()->user()->id,
                    'url' => 'افزودن فیلتر ' . $this->title,
                    'actionType' => 'افزودن'
                ]);
                $msg = 'افزودن فیلتر با موفقیت انجام شد.';
                return redirect(route('Filters'))->with('sucsess', $msg);
            }
        } else {

            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }

    public function render()
    {
        $categories = Category::where('parent', 0)->
        orWhere('parent', NULL)->
        get();
        return view('livewire.admin.filter.add', compact('categories'));
    }

}
