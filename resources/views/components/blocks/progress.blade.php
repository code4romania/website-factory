<div class="flex flex-wrap justify-between mb-8 gap-y-4 gap-x-8 md:flex-nowrap">
    <div class="flex gap-3">
        @if ($icon)
            <div
                class="flex items-center justify-center w-12 h-12 rounded-md shrink-0 text-primary bg-opacity-10 bg-primary">
                <x-dynamic-component
                    :component="$icon"
                    class="w-6 h-6"
                    aria-hidden="true"
                />
            </div>
        @endif

        <div class="space-y-1">
            <h1 class="text-base font-semibold text-gray-900">
                {{ $title }}
            </h1>

            <p class="text-sm text-gray-500 empty:hidden">
                {{ $description }}
            </p>
        </div>
    </div>

    @if ($buttonUrl && $buttonText)
        <div class="flex justify-end shrink-0 w-full text-sm items-bottom md:w-auto">
            <a
                href="{{ $buttonUrl }}"
                class="flex items-center text-primary hover:underline">
                {{ $buttonText }}

                <x-ri-arrow-right-up-line class="w-8 h-8 ml-2 shrink-0" />
            </a>
        </div>
    @endif
</div>

<div
    role="progressbar"
    aria-valuemin="0"
    aria-valuemax="100"
    aria-valuenow="{{ $progress }}"
    class="flex items-center w-full h-10 gap-4 bg-gray-100">

    @if ($progress < 25)
        <div class="h-full bg-primary" style="width: {{ $progress }}%"></div>
        <span class="text-2xl font-bold text-primary">{{ $progress }}%</span>
    @else
        <div class="flex items-center justify-end h-full px-1 text-xs text-center bg-primary"
            style="width: {{ $progress }}%">
            <span class="text-2xl font-bold text-white">{{ $progress }}%</span>
        </div>
    @endif

</div>
