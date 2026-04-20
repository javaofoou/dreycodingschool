<?php

use App\Models\ProjectRequest;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    public string $search = '';
    public string $status = '';
    public $requests;

    public function mount(): void
    {
        $this->loadRequests();
    }

    public function updatedSearch(): void
    {
        $this->loadRequests();
    }

    public function updatedStatus(): void
    {
        $this->loadRequests();
    }

    public function loadRequests(): void
    {
        $this->requests = ProjectRequest::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('full_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('project_type', 'like', '%' . $this->search . '%')
                      ->orWhere('whatsapp_number', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->latest()
            ->get();
    }

    public function updateStatus(int $id, string $status): void
    {
        $request = ProjectRequest::findOrFail($id);
        $request->update(['status' => $status]);

        $this->loadRequests();

        session()->flash('success', 'Project request status updated.');
    }
};
?>

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Project Requests</h1>
        <p class="mt-2 text-sm text-gray-600">View all submitted client requests.</p>
    </div>

    @if (session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 grid grid-cols-1 gap-4 rounded-3xl bg-white p-5 shadow-sm ring-1 ring-gray-200 md:grid-cols-2">
        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Search</label>
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search by name, email, type, or WhatsApp"
                class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm"
            >
        </div>

        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Status</label>
            <select wire:model.live="status" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
                <option value="">All Statuses</option>
                <option value="new">New</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>
    </div>

    <div class="space-y-5">
        @forelse ($this->requests as $request)
            <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $request->full_name }}</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ $request->email }}</p>
                        <p class="mt-1 text-sm text-gray-600">{{ $request->whatsapp_number }}</p>
                        <p class="mt-1 text-sm font-medium text-indigo-600">{{ $request->project_type }}</p>
                    </div>

                    <div class="text-sm text-gray-600">
                        <p>Status: {{ ucfirst(str_replace('_', ' ', $request->status)) }}</p>
                        <p class="mt-1">Budget: {{ $request->budget_range ?: 'Not specified' }}</p>
                    </div>
                </div>

                <div class="mt-4 rounded-2xl bg-gray-50 p-4">
                    <p class="text-sm leading-7 text-gray-700">{{ $request->project_description }}</p>
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    <button wire:click="updateStatus({{ $request->id }}, 'new')" class="rounded-xl bg-gray-600 px-3 py-2 text-xs font-semibold text-white">New</button>
                    <button wire:click="updateStatus({{ $request->id }}, 'in_progress')" class="rounded-xl bg-yellow-600 px-3 py-2 text-xs font-semibold text-white">In Progress</button>
                    <button wire:click="updateStatus({{ $request->id }}, 'completed')" class="rounded-xl bg-green-600 px-3 py-2 text-xs font-semibold text-white">Completed</button>
                </div>
            </div>
        @empty
            <div class="rounded-3xl bg-white p-10 text-center shadow-sm ring-1 ring-gray-200">
                <p class="text-sm text-gray-600">No project requests found.</p>
            </div>
        @endforelse
    </div>
</div>