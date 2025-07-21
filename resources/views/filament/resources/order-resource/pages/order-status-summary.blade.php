{{-- <div class="mb-8"> --}}
    <div class="grid grid-cols-5 sm:grid-cols-2 md:grid-cols-5 gap-8">
        <div class="bg-gradient-to-br from-yellow-200 to-yellow-400 text-gray-900 rounded-2xl shadow-xl border border-yellow-300 p-6 flex flex-col items-center transition-transform hover:-translate-y-1 hover:shadow-2xl duration-200">
            <div class="flex items-center gap-2 mb-2">
                <x-heroicon-o-clock class="w-7 h-7 text-yellow-600" />
                <span class="font-semibold text-lg">Pending</span>
            </div>
            <span class="text-4xl font-extrabold tracking-tight mb-1">{{ $pending }}</span>
            <span class="text-xs text-yellow-800">Orders awaiting payment</span>
        </div>
        <div class="bg-gradient-to-br from-green-200 to-green-500 text-gray-900 rounded-2xl shadow-xl border border-green-300 p-6 flex flex-col items-center transition-transform hover:-translate-y-1 hover:shadow-2xl duration-200">
            <div class="flex items-center gap-2 mb-2">
                <x-heroicon-o-currency-dollar class="w-7 h-7 text-green-700" />
                <span class="font-semibold text-lg">Paid</span>
            </div>
            <span class="text-4xl font-extrabold tracking-tight mb-1">{{ $paid }}</span>
            <span class="text-xs text-green-900">Orders successfully paid</span>
        </div>
        <div class="bg-gradient-to-br from-blue-200 to-blue-500 text-gray-900 rounded-2xl shadow-xl border border-blue-300 p-6 flex flex-col items-center transition-transform hover:-translate-y-1 hover:shadow-2xl duration-200">
            <div class="flex items-center gap-2 mb-2">
                <x-heroicon-o-truck class="w-7 h-7 text-blue-700" />
                <span class="font-semibold text-lg">On Its Way</span>
            </div>
            <span class="text-4xl font-extrabold tracking-tight mb-1">{{ $on_its_way }}</span>
            <span class="text-xs text-blue-900">Orders being delivered</span>
        </div>
        <div class="bg-gradient-to-br from-red-200 to-red-500 text-gray-900 rounded-2xl shadow-xl border border-red-300 p-6 flex flex-col items-center transition-transform hover:-translate-y-1 hover:shadow-2xl duration-200">
            <div class="flex items-center gap-2 mb-2">
                <x-heroicon-o-x-circle class="w-7 h-7 text-red-700" />
                <span class="font-semibold text-lg">Cancelled</span>
            </div>
            <span class="text-4xl font-extrabold tracking-tight mb-1">{{ $cancelled }}</span>
            <span class="text-xs text-red-900">Orders that were cancelled</span>
        </div>
        <div class="bg-gradient-to-br from-indigo-200 to-indigo-600 text-gray-900 rounded-2xl shadow-xl border border-indigo-300 p-6 flex flex-col items-center transition-transform hover:-translate-y-1 hover:shadow-2xl duration-200">
            <div class="flex items-center gap-2 mb-2">
                <x-heroicon-o-check-circle class="w-7 h-7 text-indigo-700" />
                <span class="font-semibold text-lg">Delivered</span>
            </div>
            <span class="text-4xl font-extrabold tracking-tight mb-1">{{ $delivered }}</span>
            <span class="text-xs text-indigo-900">Orders delivered to customer</span>
        </div>
    </div>
{{-- </div>  --}}