<?php

namespace App\Http\Livewire\Admin\Option;

use App\Jobs\DefaultNotification;
use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Models\Question as QuestionModels;

class EditQuestion extends Component
{
    public QuestionModels $question;
    protected $rules = [
        'question.question' => 'required|string',
        'question.answer' => 'nullable|string|min:3',
        'question.status' => 'nullable',
    ];

    public function mount($edit)
    {
        $this->question = QuestionModels::where('id', $edit)->first();

    }

    public function updateInfo()
    {
        if (Gate::allows('edit_product')) {
            $this->validate();
            $this->question->update();
            if ($this->question->answer) {
                $user = User::where('id', $this->question->user_id)->first();
                DefaultNotification::dispatch($user, 'question_answer');
            }
            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'ویرایش پرسش' . '-' . auth()->user()->name,
                'actionType' => 'ویرایش'
            ]);
            $msg = 'ویرایش موفقیت امیز بود.';
            return (redirect(route('Questions')))->with('sucsess', $msg);

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }
    }

    public function render()
    {
        return view('livewire.admin.option.edit-question');
    }
}
