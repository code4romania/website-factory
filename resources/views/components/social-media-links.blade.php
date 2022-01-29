<div {{ $attributes->class('flex space-x-4') }}>
    @foreach ($links as $link)
        <a
            href="{{ $link['prefix'] }}{{ $link['value'] }}"
            target="_blank"
            rel="noopener noreferer"
            class="text-gray-400 hover:text-gray-500">
            <span class="sr-only">{{ $link['label'] }}</span>
            <x-dynamic-component :component="$link['icon']" class="w-5 h-5" aria-hidden="true" />
        </a>
    @endforeach
</div>
