<?php

use App\Models\User;
use Livewire\Volt\Component;
use function Livewire\Volt\{layout};

layout('components.layouts.app');

new class extends Component {
    public string $search = '';
    public string $role = '';

    public function getStudentsProperty()
    {
        return User::withCount('enrollments')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('whatsapp_number', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->role, function ($query) {
                $query->where('role', $this->role);
            })
            ->latest()
            ->get();
    }
};
?>

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Students</h1>
        <p class="mt-2 text-sm text-gray-600">View all registered users on the platform.</p>
    </div>

    <div class="mb-6 grid grid-cols-1 gap-4 rounded-3xl bg-white p-5 shadow-sm ring-1 ring-gray-200 md:grid-cols-2">
        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Search</label>
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Search by name, email, or WhatsApp"
                class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm"
            >
        </div>

        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700">Role</label>
            <select wire:model.live="role" class="w-full rounded-2xl border border-gray-300 px-4 py-3 text-sm">
                <option value="">All Roles</option>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
        </div>
    </div>

    <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Student</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">WhatsApp</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Role</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Enrollments</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Joined</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($this->students as $student)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($student->profile_image)
                                        <img
                                            src="{{ $student->profile_image }}"
                                            alt="{{ $student->name }}"
                                            class="h-10 w-10 rounded-full object-cover"
                                        >
                                    @else
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700">
                                            {{ $student->initials() }}
                                        </div>
                                    @endif

                                    <span class="text-sm font-medium text-gray-900">{{ $student->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student->whatsapp_number }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($student->role) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student->enrollments_count }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $student->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-600">
                                No students found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>