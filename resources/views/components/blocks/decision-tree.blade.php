<x-blocks._title :title="$title" />

<div x-data="{
    current: @js($items->first()?->input('id')),
    isCurrent: function(id) {
        return this.current === id;
    },
    setCurrent: function(id) {
        this.current = id;
    }
}">
    @foreach ($items as $item)
        <div
            x-show="isCurrent(@js($item->input('id')))"
            x-cloak
        >
            <h2>{{ $item->translatedInput('title') }}</h2>

            @foreach ($item->children as $choice)
                <button @@click="setCurrent(@js($choice->input('step')))">
                    {!! $choice->translatedInput('text') !!}
                </button>
            @endforeach
        </div>
    @endforeach
</div>
