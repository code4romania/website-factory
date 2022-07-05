@props([
    'items' => collect(),
])

<div {{ $attributes->class('flex flex-wrap gap-4 empty:hidden sm:gap-6') }}>
    @foreach ($items as $item)
        <a href="{{ $item->getUrl() }}" download
            class="relative flex items-center w-full ring-1 ring-gray-200 sm:w-auto">
            <div @class([
                'flex items-center justify-center flex-shrink-0 w-16 h-16 p-4 text-white',
                'bg-red-600' => $item->aggregate_type === 'pdf',
                'bg-rose-600' => $item->aggregate_type === 'video',
                'bg-teal-600' => $item->aggregate_type === 'audio',
                'bg-yellow-600' => $item->aggregate_type === 'archive',
                'bg-blue-600' => $item->aggregate_type === 'document',
                'bg-green-600' => $item->aggregate_type === 'spreadsheet',
                'bg-orange-600' => $item->aggregate_type === 'presentation',
                'bg-gray-300' => $item->aggregate_type === 'other',
            ])>
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
