<x-blocks._title :title="$title" />

<div class="prose prose-primary md:prose-lg">
    {!! $html !!}
</div>

<div class="mt-8 overflow-hidden bg-zinc-100">
    <script>
        var {{ $dataKey }} = @json([
            'name' => $title,
            'data' => $chartData,
        ]);
    </script>

    <div x-data x-budget="{{ $dataKey }}" class="w-full max-h-screen aspect-[2/3] md:aspect-[3/2]"></div>
</div>
