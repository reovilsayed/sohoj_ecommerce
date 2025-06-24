<x-filament::page>
    {{ $this->form }}

    <x-filament::button wire:click="submit" class="mt-4">
        Save Settings
    </x-filament::button>
</x-filament::page>
