@if ($element === 'a')
    <a href="{{ $href }}"
        {{ $attributes->merge([
            'class' => $class(),
        ]) }}>

        @if ($icon)
            <x-dynamic-component :component="$icon" :class="$iconClass()" />
        @endif

        {{ $slot }}
    </a>
@else
    <button type="button"
        {{ $attributes->merge([
            'class' => $class(),
        ]) }}>

        @if ($icon)
            <x-dynamic-component :component="$icon" :class="$iconClass()" />
        @endif

        {{ $slot }}
    </button>
@endif
