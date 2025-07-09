<x-filament::page>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form wire:submit.prevent="save">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-3">
            Save Settings
        </x-filament::button>
    </form>
</x-filament::page>
