<x-blocks._title :title="$title" />

<div @class(['grid gap-x-8 gap-y-16', $columns])>
    @foreach ($items as $item)
        <div class="overflow-hidden border border-gray-100 rounded-lg shadow-md">
            <div class="flex gap-4 px-4 py-5 sm:p-6">
                @if ($item->input('icon'))
                    <div
                        class="flex items-center justify-center w-12 h-12 border rounded-md text-primary bg-primary/10 border-primary/25 shrink-0">
                        {{ svg("ri-{$item->input('icon')}", 'w-6 h-6') }}
                    </div>
                @endif

                <div class="flex flex-col flex-1">
                    <dt @class([
                        'text-sm font-medium text-gray-500 leading-6',
                        'order-2' => $item->checkbox('show_label_under_value'),
                    ])>
                        {{ $item->translatedInput('label') }}
                    </dt>
                    <dd @class([
                        'text-2xl font-semibold text-gray-900',
                        'order-1' => $item->checkbox('show_label_under_value'),
                    ])>
                        {{ $item->input('value') }}
                    </dd>
                </div>
            </div>

        </div>
    @endforeach
</div>
