<?php

namespace App\Http\Livewire\Admin\Page;

use App\Models\Banner;
use App\Models\Carsoul;
use App\Models\Colum;
use App\Models\Html;
use App\Models\Log;
use App\Models\Module;
use App\Models\Page;
use App\Models\Proposal;
use App\Models\RowModule;
use App\Models\SiteOption;
use App\Models\Slider;
use App\Models\Tab;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Add extends Component
{
    public $page;
    public $showOptionUl = [];
    public $row_magin_top = [], $row_magin_right = [], $row_magin_bottom = [], $row_magin_left = [], $row_bg_color = [], $row_bg_color_status = [], $row_height = [];
    public $row_padding_top = [], $row_padding_right = [], $row_padding_bottom = [], $row_padding_left = [], $row_full_page = [];
    public $module_magin_top = [], $module_magin_right = [], $module_magin_bottom = [], $module_magin_left = [];
    public $module_padding_top = [], $module_padding_right = [], $module_padding_bottom = [], $module_padding_left = [];
    public $optionType1 = [];
    public $modules = [], $module_name = [], $moduleName;
    public $col = [], $col_sm, $col_lg = [], $col_xs = [], $col_md = [];
    public $t1 = 1, $t2 = 1, $t3 = 0;
    public $rows;
    public $hidesection = false;
    public $result = null;
    protected $rules = [
        'page.title' => 'required|string|min:2|max:255',
        'page.link' => 'required|string|min:2|unique:pages,link',
        'page.meta_description' => 'nullable|string|min:3',
        'page.meta_title' => 'nullable|string|min:2|max:255',
        'page.meta_keyword' => 'nullable|string|min:2|max:255',
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
            return view('livewire.admin.page.add');
        }
        $this->page = new Page();
    }

    public function addRow($t1)
    {
        array_push($this->showOptionUl, $t1);
        $t1++;
        $this->col_sm = '';
    }

    public function removeRow($id)
    {

        unset($this->showOptionUl[$id]);
        unset($this->row_magin_top[$id]);
        unset($this->row_magin_right[$id]);
        unset($this->row_magin_left[$id]);
        unset($this->row_magin_bottom[$id]);
        unset($this->row_padding_top[$id]);
        unset($this->row_padding_right[$id]);
        unset($this->row_padding_left[$id]);
        unset($this->row_padding_bottom[$id]);
        unset($this->row_bg_color_status[$id]);
        unset($this->row_bg_color[$id]);
        unset($this->row_height[$id]);
        unset($this->row_full_page[$id]);
        if (isset($this->optionType1[$id])) {
            foreach ($this->optionType1[$id] as $key => $value) {
                if (isset($this->modules[$id][$key])) {
                    foreach ($this->modules[$id][$key] as $key1 => $value1) {
                        unset($this->module_magin_top[$id]);
                        unset($this->module_magin_right[$id]);
                        unset($this->module_magin_left[$id]);
                        unset($this->module_magin_bottom[$id]);
                        unset($this->module_padding_top[$id]);
                        unset($this->module_padding_right[$id]);
                        unset($this->module_padding_left[$id]);
                        unset($this->module_padding_bottom[$id]);
                        unset($this->module_radius[$id]);
                        unset($this->module_border_color[$id]);
                        unset($this->module_border_font[$id]);
                        unset($this->module_border_style[$id]);
                        unset($this->module_mobile_display[$id]);
                        unset($this->module_tablet_display[$id]);
                        unset($this->module_laptop_display[$id]);
                        unset($this->module_background_color[$id]);
                        unset($this->module_full_page[$id]);
                        unset($this->module_height[$id]);

                    }
                    unset($this->modules[$id]);
                    unset($this->modules[$id][$key]);
                    unset($this->module_name[$id][$key]);
                    unset($this->module_name[$id]);
                }
                unset($this->optionType1[$id][$key]);
                unset($this->optionType1[$id]);
                unset($this->col[$id][$key]);
                unset($this->col[$id]);
            }
        }
    }

    public function AddColum($t2, $key)
    {

        if ($this->col_sm !== '') {
            $t2 = $t2 + 1;
            $this->t2 = $t2;
            $this->optionType1[$key][$t2] = $t2;
            $this->col[$key][$t2] = ($this->col_sm);
            $this->col_sm = '';
        }

    }

    public function AddModule($t3, $key, $key1)
    {

        if ($this->moduleName !== '') {
            $t3 = $t3 + 1;
            $this->t3 = $t3;
            $this->modules[$key][$key1][$t3] = $t3;
            $this->module_name[$key][$key1][$t3] = ($this->moduleName);
            $this->moduleName = '';
        }

    }

    public function removeColum($key, $t2)
    {
        unset($this->optionType1[$key][$t2]);
        unset($this->col[$key][$t2]);
        unset($this->col_xs[$key][$t2]);
        unset($this->col_md[$key][$t2]);
        unset($this->col_lg[$key][$t2]);
    }

    public function removemodule($key, $key1, $t3)
    {
        unset($this->modules[$key][$key1][$t3]);
        unset($this->module_name[$key][$key1][$t3]);
        unset($this->module_magin_top[$key][$key1][$t3]);
        unset($this->module_magin_right[$key][$key1][$t3]);
        unset($this->module_magin_left[$key][$key1][$t3]);
        unset($this->module_magin_bottom[$key][$key1][$t3]);
        unset($this->module_padding_top[$key][$key1][$t3]);
        unset($this->module_padding_right[$key][$key1][$t3]);
        unset($this->module_padding_left[$key][$key1][$t3]);
        unset($this->module_padding_bottom[$key][$key1][$t3]);

    }

    public function updated($title)
    {
        $this->validateOnly($title);
    }

    public function saveTotalData()
    {
        if (Gate::allows('edit_page')) {

            $this->validate();
            $this->page->save();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن صفحه سایت' . '-' . $this->page->title,
                'actionType' => 'ایجاد'
            ]);
            $sections = RowModule:: where('page', $this->page->title)->get();
            foreach ($sections as $section) {
                $section->delete();
            }
            $cols = Colum:: where('page', $this->page->title)->get();
            foreach ($cols as $col) {

                $col->delete();
            }
            $modules = Module:: where('page', $this->page->title)->get();
            if ($modules) {
                foreach ($modules as $module) {
                    $module->delete();
                }
            }
            foreach ($this->showOptionUl as $key => $value) {
                $i = 0;
                if (isset($this->col[$key])) {
                    foreach ($this->col[$key] as $key1 => $value1) {

                        $newcol = new Colum();
                        $newcol->row = $key;
                        $newcol->page = $this->page->title;
                        $newcol->col = $value1;
                        if (isset($this->col_xs[$key][$key1])) {
                            $newcol->col_xs = $this->col_xs[$key][$key1];
                        }
                        if (isset($this->col_md[$key][$key1])) {
                            $newcol->col_md = $this->col_md[$key][$key1];
                        }
                        if (isset($this->col_lg[$key][$key1])) {
                            $newcol->col_lg = $this->col_lg[$key][$key1];
                        }
                        $newcol->sort = $i;
                        $newcol->save();
                        $j = 0;
                        if (isset($this->module_name[$key][$key1])) {
                            foreach ($this->module_name[$key][$key1] as $key2 => $value2) {

                                $newModule = new Module();
                                $newModule->row = $key;
                                $newModule->page = $this->page->title;
                                $newModule->module_id = $value2;
                                $newModule->col = $i;
                                $newModule->sort = $j;
                                $margin = '';
                                if (isset($this->module_magin_top[$key][$key1][$key2])) {
                                    $margin = $this->module_magin_top[$key][$key1][$key2];
                                } else {
                                    $margin = 'no';
                                }
                                if (isset($this->module_magin_right[$key][$key1][$key2])) {
                                    $margin = $margin . ',' . $this->module_magin_right[$key][$key1][$key2];
                                } else {
                                    $margin = $margin . ',' . 'no';
                                }
                                if (isset($this->module_magin_bottom[$key][$key1][$key2])) {
                                    $margin = $margin . ',' . $this->module_magin_bottom[$key][$key1][$key2];
                                } else {
                                    $margin = $margin . ',' . 'no';
                                }
                                if (isset($this->module_magin_left[$key][$key1][$key2])) {
                                    $margin = $margin . ',' . $this->module_magin_left[$key][$key1][$key2];
                                } else {
                                    $margin = $margin . ',' . 'no';
                                }
                                $padding = '';
                                if (isset($this->module_padding_top[$key][$key1][$key2])) {
                                    $padding = $this->module_padding_top[$key][$key1][$key2];
                                } else {
                                    $padding = 'no';
                                }
                                if (isset($this->module_padding_right[$key][$key1][$key2])) {
                                    $padding = $padding . ',' . $this->module_padding_right[$key][$key1][$key2];
                                } else {
                                    $padding = $padding . ',' . 'no';
                                }
                                if (isset($this->module_padding_bottom[$key][$key1][$key2])) {
                                    $padding = $padding . ',' . $this->module_padding_bottom[$key][$key1][$key2];
                                } else {
                                    $padding = $padding . ',' . 'no';
                                }
                                if (isset($this->module_padding_left[$key][$key1][$key2])) {
                                    $padding = $padding . ',' . $this->module_padding_left[$key][$key1][$key2];
                                } else {
                                    $padding = $padding . ',' . 'no';
                                }
                                if (isset($this->module_border_style[$key][$key1][$key2])) {
                                    $newModule->border_style = $this->module_border_style[$key][$key1][$key2];
                                }
                                $newModule->margin = $margin;
                                $newModule->padding = $padding;
                                $newModule->save();
                                $j++;
                            }
                        }
                        $i++;
                    }
                }
                $row = new RowModule();
                $row->sort = $key;
                $row->page = $this->page->title;
                $margin = '';
                if (isset($this->row_magin_top[$key])) {
                    $margin = $this->row_magin_top[$key];
                } else {
                    $margin = 'no';
                }
                if (isset($this->row_magin_right[$key])) {
                    $margin = $margin . ',' . $this->row_magin_right[$key];
                } else {
                    $margin = $margin . ',' . 'no';
                }
                if (isset($this->row_magin_bottom[$key])) {
                    $margin = $margin . ',' . $this->row_magin_bottom[$key];
                } else {
                    $margin = $margin . ',' . 'no';
                }
                if (isset($this->row_magin_left[$key])) {
                    $margin = $margin . ',' . $this->row_magin_left[$key];
                } else {
                    $margin = $margin . ',' . 'no';
                }
                $padding = '';
                if (isset($this->row_padding_top[$key])) {
                    $padding = $this->row_padding_top[$key];
                } else {
                    $padding = 'no';
                }
                if (isset($this->row_padding_right[$key])) {
                    $padding = $padding . ',' . $this->row_padding_right[$key];
                } else {
                    $padding = $padding . ',' . 'no';
                }
                if (isset($this->row_padding_bottom[$key])) {
                    $padding = $padding . ',' . $this->row_padding_bottom[$key];
                } else {
                    $padding = $padding . ',' . 'no';
                }
                if (isset($this->row_padding_left[$key])) {
                    $padding = $padding . ',' . $this->row_padding_left[$key];
                } else {
                    $padding = $padding . ',' . 'no';
                }
                if (isset($this->row_full_page[$key])) {
                    $row->fullpage = $this->row_full_page[$key];
                }
                if (isset($this->row_bg_color[$key])) {
                    $row->bg_color = $this->row_bg_color[$key];
                }
                if (isset($this->row_bg_color_status[$key])) {
                    $row->bg_color_status = $this->row_bg_color_status[$key];
                }
                if (isset($this->row_height[$key])) {
                    $row->height = $this->row_height[$key];
                }
                $row->margin = $margin;
                $row->padding = $padding;
                $row->save();

            }
            $msg = 'صفحه سایت با موفقیت ایجاد  شد';
            return redirect(route('pages'))->with('sucsess', $msg);

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function render()
    {
        $showrow = $this->showOptionUl;
        $sliders = Slider::where('status', 1)->get();
        $carsouls = Carsoul::where('status', 1)->get();
        $banners = Banner::get();
        $specials = Proposal::where('status', 1)->get();
        $tabs = Tab::where('status', 1)->get();
        $htmls = Html::get();
        return view('livewire.admin.page.add', compact('htmls', 'tabs', 'showrow', 'sliders', 'carsouls', 'banners', 'specials'));
    }
}
