<?php

use App\Models\Faq;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    public Faq $faq;
    public string $question = '';
    public string $answer = '';
    public bool $is_active = true;

    public function mount(Faq $faq): void
    {
        $this->faq = $faq;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->is_active = (bool) $faq->is_active;
    }

    public function update(): void
    {
        $validated = $this->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'is_active' => ['boolean'],
        ]);

        $this->faq->update($validated);

        session()->flash('success', 'FAQ updated successfully.');

        $this->redirect(route('admin.faqs.index', absolute: false), navigate: true);
    }
};
?>

<div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit FAQ</h1>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
        <form wire:submit="update" class="space-y-5">
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Question</label>
                <input type="text" wire:model.defer="question" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
            </div>

            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700">Answer</label>
                <textarea wire:model.defer="answer" rows="5" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm"></textarea>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" wire:model.defer="is_active" id="faq_active" class="rounded border-gray-300">
                <label for="faq_active" class="text-sm font-medium text-gray-700">Active</label>
            </div>

            <button type="submit" class="rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-700">
                Update FAQ
            </button>
        </form>
    </div>
</div>