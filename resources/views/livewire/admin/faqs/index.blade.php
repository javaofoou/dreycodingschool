<?php

use App\Models\Faq;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    public $faqs;

    public function mount(): void
    {
        $this->faqs = Faq::latest()->get();
    }

    public function deleteFaq(int $id): void
    {
        Faq::findOrFail($id)->delete();
        $this->faqs = Faq::latest()->get();
        session()->flash('success', 'FAQ deleted successfully.');
    }
};
?>

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">FAQs</h1>
            <p class="mt-2 text-sm text-gray-600">View all FAQ entries.</p>
        </div>

        <a href="{{ route('admin.faqs.create') }}" class="rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700" wire:navigate>
            Add FAQ
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-5">
        @forelse ($this->faqs as $faq)
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">{{ $faq->question }}</h2>
                        <p class="mt-3 text-sm leading-7 text-gray-600">{{ $faq->answer }}</p>
                        <p class="mt-3 text-sm text-gray-500">Status: {{ $faq->is_active ? 'Active' : 'Inactive' }}</p>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="rounded-xl bg-blue-600 px-3 py-2 text-xs font-semibold text-white hover:bg-blue-700" wire:navigate>
                            Edit
                        </a>
                        <button wire:click="deleteFaq({{ $faq->id }})" wire:confirm="Are you sure?" class="rounded-xl bg-red-600 px-3 py-2 text-xs font-semibold text-white hover:bg-red-700">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-3xl bg-white p-10 text-center shadow-sm ring-1 ring-gray-200">
                <p class="text-sm text-gray-600">No FAQs found.</p>
            </div>
        @endforelse
    </div>
</div>