<x-filament-forms::field-wrapper label="Admin Email" statePath="admin_email" hint="Enter admin contact email">
    <input type="email" id="admin_email" name="admin_email"
        class="w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm 
                                focus:border-primary-500 focus:ring-1 focus:ring-primary-500
                                dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-500"
        placeholder="admin@example.com" value="{{ old('admin_email', $settings['admin_email'] ?? '') }}" />
</x-filament-forms::field-wrapper>

<x-filament-forms::field-wrapper label="Admin Phone" statePath="admin_phone" hint="Enter admin contact phone">
    <input type="tel" id="admin_phone" name="admin_phone"
        class="w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm 
                                focus:border-primary-500 focus:ring-1 focus:ring-primary-500
                                dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-500"
        placeholder="+1 234 567 8900" value="{{ old('admin_phone', $settings['admin_phone'] ?? '') }}" />
</x-filament-forms::field-wrapper>

<x-filament-forms::field-wrapper label="Admin Shipping" statePath="admin_shipping" hint="Enter admin shipping phone">
    <input type="text" id="admin_shipping" name="admin_shipping"
        class="w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm 
                                focus:border-primary-500 focus:ring-1 focus:ring-primary-500
                                dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-500"
        placeholder="Shipping Cost" value="{{ old('admin_shipping', $settings['admin_shipping'] ?? '') }}" />
</x-filament-forms::field-wrapper>

<x-filament-forms::field-wrapper label="Admin Address" statePath="about" hint="Enter admin address">
    <textarea id="about" name="about" rows="3"
        class="w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm 
                                focus:border-primary-500 focus:ring-1 focus:ring-primary-500
                                dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 dark:placeholder-gray-500"
        placeholder="Enter admin address">{{ old('about', $settings['about'] ?? '') }}</textarea>
</x-filament-forms::field-wrapper>
