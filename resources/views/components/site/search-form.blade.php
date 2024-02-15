@props([
    'query' => null,
])

<form
    {{ $attributes->merge([
        'method' => 'get',
        'action' => $action,
    ]) }}>

    <label class="relative flex items-center ">
        <span class="sr-only">@lang('app.search.placeholder')</span>

        <button
            type="submit"
            class="absolute inset-y-0 flex items-center w-5 h-full left-4">
            <x-ri-search-line class="w-full h-full text-gray-300" />
        </button>

        <input
            type="search"
            name="query"
            ref="input"
            class="items-center block w-full px-4 py-2 pl-12 pr-3 text-left text-gray-900 placeholder-gray-400 bg-white border-none shadow-sm sm:flex ring-1 ring-gray-900/10 hover:ring-gray-300 focus:outline-none focus:ring-2 focus:ring-primary"
            placeholder="{{ __('app.search.placeholder') }}"
            autocomplete="off"
            value="{{ $query }}">
    </label>
</form>
