<x-app-sidebar-layout title="Office">
    <x-slot name="header">
        <div class="page-title-overlap bg-accent"></div>
    </x-slot>

    {{-- Content --}}
    <livewire:product.office.edit :product="$product" />
</x-app-sidebar-layout>
