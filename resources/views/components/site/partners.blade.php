<aside class="border-b">
    <div class="container flex items-center gap-4 sm:justify-end md:gap-x-8">
        @if(env('APP_URL') != 'https://app.crestem.ong/')
            <span class="text-sm font-medium text-gray-600">@lang('partner.banner')</span>
        @endif
        <div class="flex flex-wrap items-center justify-end flex-1 gap-4 py-5 lg:gap-x-6 sm:flex-initial">
            @foreach ($partners as $partner)
                @if ($partner->url)
                    <a
                        href="{{ $partner->url }}"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex hover:ring-1 ring-primary focus:outline-none focus:ring-2 ring-offset-2 px-2.5 py-1.5 shrink-0"
                        title="{{ $partner->name }}">
                        @if(env('APP_URL') != 'https://app.crestem.ong/')
                            <img class="object-contain h-[80px]" src="{{ $partner->logo }}" alt="{{ $partner->name }}">
                        @else
                            <img class="object-contain h-12" src="{{ $partner->logo }}" alt="{{ $partner->name }}">
                        @endif
                    </a>
                @else
                    <span class="inline-flex shrink-0">
                        <img class="object-contain h-12" src="{{ $partner->logo }}" alt="{{ $partner->name }}">
                    </span>
                @endif
            @endforeach
        </div>
    </div>
</aside>
