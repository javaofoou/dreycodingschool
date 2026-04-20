<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
              <img src="https://res.cloudinary.com/dxp2nia6s/image/upload/v1776687647/1002774238-removebg-preview_thfrai.png" class="h-10 w-auto">
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group heading="Platform" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>Dashboard</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                    Repository
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits" target="_blank">
                    Documentation
                </flux:navlist.item>
            </flux:navlist>
            
          @if(auth()->user()?->role === 'admin')
    <flux:navlist.group heading="Admin" class="grid">
        <flux:navlist.item
            icon="shield-check"
            :href="route('admin.dashboard')"
            :current="request()->routeIs('admin.dashboard')"
            wire:navigate
        >
            Admin Dashboard
        </flux:navlist.item>

        <flux:navlist.item
            icon="book-open"
            :href="route('admin.courses.index')"
            :current="request()->routeIs('admin.courses.*')"
            wire:navigate
        >
            Courses
        </flux:navlist.item>

        <flux:navlist.item
            icon="credit-card"
            :href="route('admin.payments.index')"
            :current="request()->routeIs('admin.payments.*')"
            wire:navigate
        >
           Payments
        </flux:navlist.item>
        <flux:navlist.item
    icon="users"
    :href="route('admin.students.index')"
    :current="request()->routeIs('admin.students.*')"
    wire:navigate
>
    Students
</flux:navlist.item>       
        <flux:navlist.item
            icon="academic-cap"
            :href="route('admin.enrollments.index')"
            :current="request()->routeIs('admin.enrollments.*')"
            wire:navigate
        >
            Enrollments
        </flux:navlist.item>

        <flux:navlist.item
            icon="briefcase"
            :href="route('admin.project-requests.index')"
            :current="request()->routeIs('admin.project-requests.*')"
            wire:navigate
        >
            Project Requests
        </flux:navlist.item>

        <flux:navlist.item
            icon="chat-bubble-left-right"
            :href="route('admin.testimonials.index')"
            :current="request()->routeIs('admin.testimonials.*')"
            wire:navigate
        >
            Testimonials
        </flux:navlist.item>

        <flux:navlist.item
            icon="question-mark-circle"
            :href="route('admin.faqs.index')"
            :current="request()->routeIs('admin.faqs.*')"
            wire:navigate
        >
            FAQs
        </flux:navlist.item>
        <flux:navlist.item
    icon="heart"
    :href="route('admin.donations.index')"
    :current="request()->routeIs('admin.donations.*')"
    wire:navigate
>
    Donations
</flux:navlist.item>
    </flux:navlist.group>
@endif

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>Settings</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>Settings</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
