@props([
    'items' => collect(),
])

<div class="flex flex-wrap gap-4 mt-3 empty:hidden md:justify-end sm:gap-6">
    @foreach ($items as $item)
        <a href="{{ $item->getUrl() }}" download
            class="relative flex items-center w-full ring-1 ring-gray-200 sm:w-auto">
            <div class="flex items-center justify-center flex-shrink-0 w-16 h-16 p-4 text-white bg-pink-600">
                <x-ri-download-line class="w-6 h-6" />
            </div>

            <div class="flex-1 px-4 py-2 text-sm truncate bg-white max-w-80">
                <div class="flex">
                    <span class="flex-1 truncate">{{ $item->filename }}</span>
                    <span class="shrink-0">.{{ $item->extension }}</span>
                </div>

                <p class="text-gray-500">{{ $item->readableSize() }}</p>
            </div>
        </a>
    @endforeach
</div>
