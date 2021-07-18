<template>
    <div class="flex justify-center flex-1 px-2 lg:ml-6 lg:justify-end">
        <div class="w-full max-w-lg lg:max-w-xs">
            <label for="search" class="sr-only">Search</label>
            <div class="relative text-gray-400 focus-within:text-gray-600">
                <icon
                    v-show="!open"
                    name="System/search-line"
                    class="absolute inset-y-0 flex items-center w-5 h-full pointer-events-none left-3"
                />
                <input
                    id="search"
                    class="block w-full py-2 pl-10 pr-3 leading-5 text-gray-300 placeholder-gray-400 bg-gray-700 border border-transparent rounded-md focus:outline-none focus:bg-white focus:border-white focus:ring-white focus:text-gray-900 sm:text-sm"
                    placeholder="Search"
                    type="search"
                    name="search"
                />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'MenuSearch',
    };
</script>
