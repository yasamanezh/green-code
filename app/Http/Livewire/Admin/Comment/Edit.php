<?php

namespace App\Http\Livewire\Admin\Comment;


use App\Models\Comment;
use App\Models\Log;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Edit extends Component
{
    public Comment $comment;
    protected $rules = [
        'comment.content' => 'required|string',
        'comment.answer' => 'nullable',
        'comment.status' => 'nullable',
    ];

    public function mount($edit)
    {
        $this->comment = Comment::where('id', $edit)->first();

    }

    public function updateInfo()
    {
        if (Gate::allows('edit_comment')){
            $this->validate();
            $this->comment->update();
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'ویرایش پرسش' . '-' . auth()->user()->name,
                'actionType' => 'ویرایش'
            ]);
            $msg = 'ویرایش موفقیت امیز بود.';
            return (redirect(route('Coments')))->with('sucsess', $msg);
        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function render()
    {
        return view('livewire.admin.comment.edit');
    }
}
