@props(['name', 'items' => null])

@php
    use App\Models\Menu;
    // If items are not passed, fetch the root items for the menu by name
    if (!$items) {
        $menu = Menu::where('name', $name)
            ->with([
                'items' => function ($query) {
                    $query->whereNull('parent_id')->orderBy('order');
                },
                'items.children',
            ])
            ->first();
        $items = $menu ? $menu->items : collect();
    }
@endphp

@if ($items && $items->count())
    <ul class="mt-4">
        @foreach ($items as $item)
            <li class="mb-2">
                <a href="{{ $item->url }}" @if ($item->target) target="{{ $item->target }}" @endif>
                    @if ($item->icon_class)
                        <i class="{{ $item->icon_class }}"></i>
                    @endif
                    {{ $item->title }}
                </a>
                @if ($item->children && $item->children->count())
                    <x-menu :items="$item->children" />
                @endif
            </li>
        @endforeach
    </ul>
@endif
