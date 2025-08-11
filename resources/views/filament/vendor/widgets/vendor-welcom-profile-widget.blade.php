<x-filament-widgets::widget>
    <x-filament::section>
        <div class="p-4">
            <h2 class="text-xl font-bold text-primary-600">
                Welcome, {{ auth()->user()->name }}! 🎉
            </h2>
            <p class="mt-2 text-gray-600">
                We’re excited to have you here.  
                Start exploring your dashboard to manage your shop and grow your business.
            </p>

            <div class="mt-4">
                <x-filament::button tag="a" href="">
                    Go to Dashboard
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

