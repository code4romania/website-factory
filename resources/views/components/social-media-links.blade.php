<div {{ $attributes->class('flex space-x-4') }}>
    @foreach ($links as $link)
        <a
            href="{{ $link['value'] }}"
            target="_blank"
            rel="noopener noreferer"
            class="hover:opacity-60">
            <span class="sr-only">{{ $link['label'] }}</span>
            <x-dynamic-component :component="$link['icon']" class="w-5 h-5" aria-hidden="true" />
        </a>
    @endforeach
</div>
