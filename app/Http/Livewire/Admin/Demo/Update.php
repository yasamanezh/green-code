<?php

namespace App\Http\Livewire\Admin\Demo;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Colum;
use App\Models\Html;
use App\Models\Log;
use App\Models\Module;
use App\Models\Demo;
use App\Models\RowModule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Update extends Component
{
    public Demo $demo;

    public $showOptionUl = [];
    public $row_magin_top=[],$row_magin_right=[],$row_magin_bottom=[],$row_magin_left=[],$row_bg_color=[],$row_bg_color_status=[],$row_height=[];
    public $row_padding_top=[],$row_padding_right=[],$row_padding_bottom=[],$row_padding_left=[],$row_full_page=[];

    public $module_magin_top=[],$module_magin_right=[],$module_magin_bottom=[],$module_magin_left=[];
    public $module_padding_top=[],$module_padding_right=[],$module_padding_bottom=[],$module_padding_left=[];


    public $optionType1=[];
    public $modules=[],$module_name=[],$moduleName;
    public $col=[],$col_sm,$col_lg=[],$col_xs=[],$col_md=[];
    public $t1=1,$t2=1,$t3=0;
    public $rows;
    public $hidesection=false;

    public function addRow($t1)
    {
        array_push($this->showOptionUl, $t1);
        $t1++;
        $this->col_sm='';
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



        if(isset($this->optionType1[$id])) {
            foreach ($this->optionType1[$id] as $key => $value) {
                if(isset($this->modules[$id][$key])){
                    foreach ($this->modules[$id][$key] as $key1=>$value1){

                        unset($this->module_magin_top[$id]);
                        unset($this->module_magin_right[$id]);
                        unset($this->module_magin_left[$id]);
                        unset($this->module_magin_bottom[$id]);
                        unset($this->module_padding_top[$id]);
                        unset($this->module_padding_right[$id]);
                        unset($this->module_padding_left[$id]);
                        unset($this->module_padding_bottom[$id]);

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
    public function AddColume($t2, $key)
    {

        if ($this->col_sm !== '') {
            $t2 = $t2 + 1;
            $this->t2 = $t2;
            $this->optionType1[$key][$t2] = $t2;
            $this->col[$key][$t2]= ($this->col_sm);
            $this->col_sm = '';}

    }
    public function AddModule($t3, $key,$key1)
    {

        if ($this->moduleName !== '') {
            $t3 = $t3 + 1;
            $this->t3 = $t3;
            $this->modules[$key][$key1][$t3] = $t3;
            $this->module_name[$key][$key1][$t3]= ($this->moduleName);
            $this->moduleName = '';}

    }
    public function removeColume($key, $t2)
    {

        unset($this->optionType1[$key][$t2]);
        unset($this->col[$key][$t2]);
        unset($this->col_xs[$key][$t2]);
        unset($this->col_md[$key][$t2]);
        unset($this->col_lg[$key][$t2]);

    }
    public function removemodule($key,$key1, $t3)
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
    public function mount(){
        $rows=RowModule::orderBy('sort','Asc')->where('page',$this->demo->title)->get();

        if($rows){
            foreach ($rows as $key=>$value){
                $t1=$this->t1;
                $t1 = $t1 + 1;
                $sort=$value->sort;
                array_push($this->showOptionUl,$sort);

                $magin=explode(',',$value->margin);
                if($magin[0] !='no'){$this->row_magin_top[$key]=$magin[0];}
                if($magin[1] !='no'){$this->row_magin_right[$key]=$magin[1];}
                if($magin[2] !='no'){$this->row_magin_bottom[$key]=$magin[2];}
                if($magin[3] !='no'){$this->row_magin_left[$key]=$magin[3];}

                $padding=explode(',',$value->padding);
                if($padding[0] !='no'){$this->row_padding_top[$key]=$padding[0];}
                if($padding[1] !='no'){$this->row_padding_right[$key]=$padding[1];}
                if($padding[2] !='no'){$this->row_padding_bottom[$key]=$padding[2];}
                if($padding[3] !='no'){$this->row_padding_left[$key]=$padding[3];}

                $this->row_full_page[$key]=$value->fullpage;
                $this->row_bg_color[$key]=$value->bg_color;
                $this->row_bg_color_status[$key]=$value->bg_color_status;
                $this->row_height[$key]=$value->height;
                $cols=Colum::where('row',$value->sort)->where('page',$this->demo->title)->get();
                if($cols) {
                    foreach ($cols as $key1 => $value1) {
                        if($value1->col){
                            $this->col_sm[$key][$key1]=$value1->col;
                        }
                        if($value1->col_lg){
                            $this->col_lg[$key][$key1]=$value1->col_lg;
                        }
                        if($value1->col_xs){
                            $this->col_xs[$key][$key1]=$value1->col_xs;
                        }
                        if($value1->col_md){
                            $this->col_md[$key][$key1]=$value1->col_md;
                        }
                        $modules = Module::where('page',$this->demo->title)->where('row', $key)->where('col', $key1)->get();

                        foreach ($modules as $key2 => $module) {
                            $t3 = $key2;
                            $this->t3 = $t3;
                            $maginModule = explode(',', $module->margin);

                            if ($maginModule[0] != 'no') {

                                $this->module_magin_top[$key][$key1][$t3] = $maginModule[0];
                            }
                            if ($maginModule[1] != 'no') {
                                $this->module_magin_right[$key][$key1][$t3] = $maginModule[1];
                            }
                            if ($maginModule[2] != 'no') {
                                $this->module_magin_bottom[$key][$key1][$t3] = $maginModule[2];
                            }
                            if ($maginModule[3] != 'no') {
                                $this->module_magin_left[$key][$key1][$t3] = $maginModule[3];
                            }

                            $paddingModule = explode(',', $module->padding);
                            if ($paddingModule[0] != 'no') {
                                $this->module_padding_top[$key][$key1][$t3] = $paddingModule[0];
                            }
                            if ($paddingModule[1] != 'no') {
                                $this->module_padding_right[$key][$key1][$t3] = $paddingModule[1];
                            }
                            if ($paddingModule[2] != 'no') {
                                $this->module_padding_bottom[$key][$key1][$t3] = $paddingModule[2];
                            }
                            if ($paddingModule[3] != 'no') {
                                $this->module_padding_left[$key][$key1][$t3] = $paddingModule[3];
                            }

                            $this->module_name[$key][$key1][$t3] = $module->module_id;
                            $this->modules[$key][$key1][$key2] = $t3;
                        }
                        $t2 = $key1;
                        $this->t2 = $t2;
                        $this->optionType1[$key][$t2] = $t2;
                        $this->col[$key][$t2] = ($value1->col);
                        $this->col_md[$key][$t2] = ($value1->col_md);
                        $this->col_lg[$key][$t2] = ($value1->col_lg);
                        $this->col_xs[$key][$t2] = ($value1->col_xs);
                    }
                }

            }
        }
    }

    protected $rules = [
        'demo.title' => 'required|string|min:2|max:255',
        'demo.link' => 'required',
        'demo.meta_description' => 'nullable|string|min:3',
        'demo.meta_title' => 'nullable|string|min:2|max:255',
        'demo.meta_keyword' => 'nullable|string|min:2|max:255',
    ];



    public function saveTotalData(){

        if(Gate::allows('edit_demo')){
            $this->validate();
            $this->validate([
                'demo.link' => ['required','string','min:2','max:255', Rule::unique('demos','link')->ignore($this->demo->id)],
            ]);
            $this->demo->update();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'ویرایش دمو' .'-'. $this->demo->title,
                'actionType' => 'ویرایش'
            ]);
            $sections=RowModule:: where('page',$this->demo->title)->get();
            foreach ($sections as $section){
                $section->delete();
            }
            $cols=Colum:: where('page',$this->demo->title)->get();
            foreach ($cols as $col) {

                $col->delete();
            }

            $modules = Module:: where('page',$this->demo->title)->get();
            if($modules){
                foreach ($modules as $module) {
                    $module->delete();
                }
            }

            foreach ($this->showOptionUl as $key=>$value){
                $i=0;
                if(isset($this->col[$key])){
                    foreach ($this->col[$key] as $key1=>$value1) {

                        $newcol = new Colum();
                        if (isset($this->col_xs[$key][$key1])){
                            $newcol->col_xs = $this->col_xs[$key][$key1];
                        }
                        if (isset($this->col_md[$key][$key1])){
                            $newcol->col_md = $this->col_md[$key][$key1];
                        }
                        if (isset($this->col_lg[$key][$key1])){
                            $newcol->col_lg = $this->col_lg[$key][$key1];
                        }
                        $newcol->row = $key;
                        $newcol->page = $this->demo->title;
                        $newcol->col = $value1;
                        $newcol->sort = $i;
                        $newcol->save();
                        $j=0;
                        if(isset($this->module_name[$key][$key1])){
                            foreach ($this->module_name[$key][$key1] as $key2 => $value2) {

                                $newModule = new Module();

                                $newModule->row = $key;
                                $newModule->page = $this->demo->title;
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


                                $newModule->margin = $margin;
                                $newModule->padding = $padding;

                                $newModule->save();
                                $j++;


                            }
                        }
                        $i++;
                    }}
                $row=new RowModule();
                $row->sort=$key;
                $row->page = $this->demo->title;
                $margin='';
                if(isset($this->row_magin_top[$key])){
                    $margin=$this->row_magin_top[$key];
                }else{
                    $margin='no';
                }
                if(isset($this->row_magin_right[$key])){
                    $margin=$margin.','.$this->row_magin_right[$key];
                }else{
                    $margin=$margin.','.'no';
                }
                if(isset($this->row_magin_bottom[$key])){
                    $margin=$margin.','.$this->row_magin_bottom[$key];
                }else{
                    $margin=$margin.','.'no';
                }
                if(isset($this->row_magin_left[$key])){
                    $margin=$margin.','.$this->row_magin_left[$key];
                }else{
                    $margin=$margin.','.'no';
                }


                $padding='';
                if(isset($this->row_padding_top[$key])){
                    $padding=$this->row_padding_top[$key];
                }else{
                    $padding='no';
                }
                if(isset($this->row_padding_right[$key])){
                    $padding=$padding.','.$this->row_padding_right[$key];
                }else{
                    $padding=$padding.','.'no';
                }
                if(isset($this->row_padding_left[$key])){
                    $padding=$padding.','.$this->row_padding_left[$key];
                }else{
                    $padding=$padding.','.'no';
                }
                if(isset($this->row_padding_bottom[$key])){
                    $padding=$padding.','.$this->row_padding_bottom[$key];
                }else{
                    $padding=$padding.','.'no';
                }


                if(isset($this->row_bg_color[$key])){
                    $row->bg_color=$this->row_bg_color[$key];
                }
                if(isset($this->row_bg_color_status[$key])){
                    $row->bg_color_status=$this->row_bg_color_status[$key];
                }
                if(isset($this->row_height[$key])){
                    $row->height=$this->row_height[$key];
                }

                if(isset($this->row_full_page[$key])){
                    $row->fullpage=$this->row_full_page[$key];
                }

                $row->margin=$margin;
                $row->padding=$padding;
                $row->save();

            }
            $msg = 'دمو با موفقیت ایجاد  شد.';
            return redirect(route('demoes'))->with('sucsess', $msg);
        }else{
            $this->emit('toast', 'warning','شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function render()
    {

        $showrow=$this->showOptionUl;
        $banners=Banner::get();

        $htmls=Html::get();

        $demo = $this->demo;
        return view('livewire.admin.demo.update',compact('demo','showrow','banners','htmls'));
    }
}
