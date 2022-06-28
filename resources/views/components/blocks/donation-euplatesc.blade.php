<div
    class="relative grid overflow-hidden border divide-y shadow-xl lg:grid-cols-2 lg:divide-y-0 lg:divide-x 2xl:grid-cols-5">
    <div class="px-4 py-12 prose 2xl:col-span-3 sm:px-6 md:px-10">
        <h1>{{ $title }}</h1>

        {!! $text !!}
    </div>

    <x-donation-form gateway="euplatesc" class="2xl:col-span-2" :block="$block" />
</div>
