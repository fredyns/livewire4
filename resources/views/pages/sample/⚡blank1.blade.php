<?php

use Illuminate\View\View;
use Livewire\Component;

new class extends Component
{
    public function render(): View
    {
        return $this->view()
            ->layout('layouts.app', ['sidebar' => 'sample'])
            ->title(__('Blank'));
    }
};
?>

<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="sticky z-10 -mx-6 px-6 h-12 flex items-center gap-3 lg:hidden bg-white/95 dark:bg-zinc-900/95 backdrop-blur border-b border-zinc-200 dark:border-white/10" style="top: 4.5rem; margin-top: -2.5rem;">
            <flux:sidebar.toggle icon="bars-2" />

            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('home') }}" icon="home" />
                <flux:breadcrumbs.item>{{ __('Blank') }}</flux:breadcrumbs.item>
            </flux:breadcrumbs>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"/>
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"/>
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern
                    class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"/>
            </div>
        </div>
        <div
            class="relative h-full flex-1 min-h-96 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern
                class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20"/>
        </div>
    </div>
</div>
