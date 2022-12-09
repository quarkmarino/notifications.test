<?php

namespace App\Http\Livewire;

use App\Enums\CategoryEnum;
use App\Models\Message;
use Illuminate\Validation\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class MessageForm extends Component
{
    use Actions;

    public $content;
    public $category;

    protected function rules()
    {
        return [
            'content' => 'required|min:6',
            'category' => [
                'required',
                Rule::in(CategoryEnum::values())
            ],
        ];
    }

    public function getCategoryOptionsProperty()
    {
        return collect(CategoryEnum::options())
            ->map(fn ($categoryValue, $categoryName) => [
                'name' => $categoryName,
                'value' => $categoryValue
            ])
            ->values();
    }

    public function render()
    {
        return view('livewire.message-form');
    }

    public function notify()
    {
        $this->validate();

        $message = new Message([
            'content' => $this->content,
            'category' => $this->category
        ]);

        if ($message->save()) {
            session()->flash('message', __('notifications.events.created.success'));

            $this->content = '';
        } else {
            session()->flash('message', __('notifications.events.created.failure'));
        }

    }
}
