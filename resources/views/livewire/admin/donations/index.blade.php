<?php

use App\Models\Donation;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    public string $search = '';
    public string $status = '';

    public function getDonationsProperty()
    {
        return Donation::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('full_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('reference', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->latest()
            ->get();
    }
};
?>

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Donations</h1>
        <p class="mt-2 text-sm text-gray-600">View all donations made to support the platform.</p>
    </div>

    <div class="mb-6 grid grid-cols-1 gap-4 rounded-3xl bg-white p-5 shadow-sm ring-1 ring-gray-200 md:grid-cols-2">
        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Search</label>
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search by name, email, or reference"
                class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm"
            >
        </div>

        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Status</label>
            <select wire:model.live="status" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
                <option value="">All Statuses</option>
                <option value="success">Success</option>
                <option value="pending">Pending</option>
                <option value="failed">Failed</option>
            </select>
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Donor</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Amount</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Reference</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($this->donations as $donation)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $donation->full_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $donation->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">₦{{ number_format($donation->amount, 0) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $donation->reference }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($donation->status) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $donation->paid_at ? $donation->paid_at->format('d M Y') : $donation->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-600">No donations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>