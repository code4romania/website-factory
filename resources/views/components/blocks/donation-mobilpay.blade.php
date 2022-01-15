<div
    class="relative grid overflow-hidden shadow-xl bg-primary rounded-xl xl:grid-cols-3">
    <div class="px-4 py-12 prose xl:col-span-2 sm:px-6 md:px-10">
        <h1>{{ $title }}</h1>

        {!! $text !!}
    </div>

    <x-donation-form class="px-4 py-12 sm:px-6 md:px-10" gateway="mobilpay" />
</div>
