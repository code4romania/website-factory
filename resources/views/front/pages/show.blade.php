<x-layout>
    <div class="container flex flex-wrap items-start gap-4">
        <x-nested-navigation :model="$page" />

        <x-blocks :model="$page" :container="false" class="flex-1" />
    </div>
</x-layout>
