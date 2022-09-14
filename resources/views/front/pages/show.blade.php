<x-layout>
    <div @class(['container', 'flex flex-wrap gap-4'])>
        <x-blocks :model="$page" :container="false" class="flex-1 md:order-2" />

        <x-nested-navigation :model="$page" class="md:order-1" />
    </div>
</x-layout>
