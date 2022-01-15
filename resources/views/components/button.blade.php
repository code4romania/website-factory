@if ($element === 'a')
    <a
        {{ $attributes->merge([
            'href' => $href,
            'class' => $class(),
        ]) }}>

        @if ($icon)
            <x-dynamic-component :component="$icon" :class="$iconClass()" />
        @endif

        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge([
            'type' => 'button',
            'class' => $class(),
        ]) }}>

        @if ($icon)
            <x-dynamic-component :component="$icon" :class="$iconClass()" />
        @endif

        {{ $slot }}
    </button>
@endif
