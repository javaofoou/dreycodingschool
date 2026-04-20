<?php

use App\Models\Payment;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    public string $search = '';
    public string $status = '';

    public function getPaymentsProperty()
    {
        return Payment::with(['user', 'course'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('reference', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function ($userQuery) {
                          $userQuery->where('name', 'like', '%' . $this->search . '%')
                                    ->orWhere('email', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('course', function ($courseQuery) {
                          $courseQuery->where('title', 'like', '%' . $this->search . '%');
                      });
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
        <h1 class="text-3xl font-bold text-gray-900">Payments</h1>
        <p class="mt-2 text-sm text-gray-600">View all payments made on the platform.</p>
    </div>

    <div class="mb-6 grid grid-cols-1 gap-4 rounded-3xl bg-white p-5 shadow-sm ring-1 ring-gray-200 md:grid-cols-2">
        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Search</label>
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search by reference, student, or course"
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
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Student</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Course</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Amount</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Reference</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($this->payments as $payment)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $payment->user->name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $payment->course->title ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">₦{{ number_format($payment->amount, 0) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $payment->reference }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($payment->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-600">No payments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>