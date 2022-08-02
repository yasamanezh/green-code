<?php

namespace App\Http\Livewire\Admin\Newsletter;

use App\Exports\EmailsExport;
use App\Models\Log;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public NewsLetter $newsletter;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $readyToLoad = false;
    public $count_data = 10;
    public $userIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $mulitiSelect = [];
    public $IdBeingRemoved = null;
    public $SelectPage = false;

    public function UpdatedSelectPage($value)
    {
        if ($value) {
            $this->mulitiSelect =NewsLetter::where('email', 'LIKE', "%{$this->search}%")
                ->orWhere('id', $this->search)
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->latest()->paginate($this->count_data)->pluck('id')->map(fn($item) => (string)$item)->toArray();

        } else {
            $this->mulitiSelect = [];
        }

    }


    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function loadNewsatter()
    {
        $this->readyToLoad = true;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function confirmAllRemoval()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteAll()
    {
        if (Gate::allows('delete_newsletter')) {
            foreach ($this->mulitiSelect as $value) {
                $user = NewsLetter::find($value);
                $user->delete();
            }
            $this->mulitiSelect = [];

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف کردن گروهی خبرنامه ',
                'actionType' => 'حذف'
            ]);
            $this->SelectPage = false;
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'success', 'رکورد مورد نظر با موفقیت حذف شد');
        } else {
            $this->dispatchBrowserEvent('hide-form');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }


    }

    public function confirmRemoval($Id)
    {
        $this->userIdBeingRemoved = $Id;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function delete()
    {
        if (Gate::allows('delete_newsletter')) {
            $user = NewsLetter::find($this->userIdBeingRemoved);

            $user->delete();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'حذف خبرنامه' . '-' . $user->name,
                'actionType' => 'ویرایش'
            ]);
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'success', 'خبرنامه با موفقیت حذف شد!');
        } else {
            $this->dispatchBrowserEvent('hide-delete-modal');
            $this->emit('toast', 'warning', 'شما اجازه حذف این قسمت را ندارید.');
        }

    }


    public function export()
    {
        if (Gate::allows('edit_newsletter')) {
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'دریافت فایل اکسل خبر نامه',
                'actionType' => 'ویرایش'
            ]);
            return (new EmailsExport())->download('emails.xlsx');
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }

    }


    public function mount()
    {
        $this->newsletter = new NewsLetter();
    }


    protected $rules = [
        'newsletter.email' => 'required|email',
    ];

    public function updated($email)
    {
        $this->validateOnly($email);
    }


    public function categoryForm()
    {
        $this->validate();

        NewsLetter::query()->create([
            'email' => $this->newsletter->email,
        ]);


        $this->newsletter->email = "";
        Log::create([
            'user_id' => auth()->user()->id,
            'url' => 'افزودن خبرنامه' . '-' . $this->newsletter->email,
            'actionType' => 'ایجاد'
        ]);
        $this->emit('toast', 'success', ' خبرنامه با موفقیت ایجاد شد.');

    }

    public function render()
    {

        $newsletters = $this->readyToLoad ? NewsLetter::where('email', 'LIKE', "%{$this->search}%")->
        orWhere('id', $this->search)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->count_data) : [];
        $deleteItem = $this->mulitiSelect;
        return view('livewire.admin.newsletter.index', compact('newsletters', 'deleteItem'));
    }
}
