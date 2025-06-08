<x-layout>
    <div class="container flex flex-wrap items-start gap-4">
        <x-nested-navigation :model="$page" />

        <x-blocks :model="$page" :container="false" class="flex-1" />
    </div>

    @if ($canEditPage)
        <a href="{{ $url_admin }}"
            class="button-edit-page fixed z-10 bottom-12 outline outline-black/5 rounded-xl bg-white shadow-xl hover:text-gray-500"
            title="{{ __('app.action.edit') }}">
            <x-ri-edit-2-fill />
        </a>
    @endif

</x-layout>