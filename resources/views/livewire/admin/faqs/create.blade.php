<?php

use App\Models\Faq;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    public string $question = '';
    public string $answer = '';
    public bool $is_active = true;

    public function save(): void
    {
        $validated = $this->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'is_active' => ['boolean'],
        ]);

        Faq::create($validated);

        session()->flash('success', 'FAQ created successfully.');

        $this->redirect(route('admin.faqs.index', absolute: false), navigate: true);
    }
};
?>

<div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Create FAQ</h1>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
        <form wire:submit="save" class="space-y-5">
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
                Save FAQ
            </button>
        </form>
    </div>
</div>