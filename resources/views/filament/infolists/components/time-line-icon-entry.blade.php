@php
    use Filament\Support\Enums\IconSize;
@endphp

<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div
        {{ $attributes->merge($getExtraAttributes(), escape: false)->class([
                'absolute flex items-center justify-center w-6 h-6 bg-gray-200 rounded-full -start-3 ring-4 ring-white dark:bg-gray-700 dark:ring-gray-900',
            ]) }}>
        @if (count($arrayState = \Illuminate\Support\Arr::wrap($getState())))
            @foreach ($arrayState as $state)
                @if ($icon = $getIcon($state))
                    @php
                        $color = $getColor($state) ?? 'gray';
                        $size = $getSize($state) ?? IconSize::Large;
                    @endphp

                    <x-filament::icon :icon="$icon" @class([
                        'fi-in-icon-item',
                        match ($size) {
                            IconSize::ExtraSmall, 'xs' => 'fi-in-icon-item-size-xs h-3 w-3',
                            IconSize::Small, 'sm' => 'fi-in-icon-item-size-sm h-4 w-4',
                            IconSize::Medium, 'md' => 'fi-in-icon-item-size-md h-5 w-5',
                            IconSize::Large, 'lg' => 'fi-in-icon-item-size-lg h-6 w-6',
                            IconSize::ExtraLarge, 'xl' => 'fi-in-icon-item-size-xl h-7 w-7',
                            IconSize::TwoExtraLarge, '2xl' => 'fi-in-icon-item-size-2xl h-8 w-8',
                            default => $size,
                        },
                        match ($color) {
                            'gray' => 'fi-color-gray text-gray-400 dark:text-gray-500',
                            default => 'fi-color-custom text-custom-500 dark:text-custom-400',
                        },
                    ]) @style([
                        \Filament\Support\get_color_css_variables($color, shades: [400, 500], alias: 'infolists::components.icon-entry.item') => $color !== 'gray',
                    ]) />
                @endif
            @endforeach
        @elseif (($placeholder = $getPlaceholder()) !== null)
            <p class="text-gray-500 fi-in-placeholder dark:text-gray-400">
                {{ $placeholder }}
            </p>
        @endif
    </div>
</x-dynamic-component>
