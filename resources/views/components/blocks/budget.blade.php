<x-blocks._title :title="$title" />

<div class="prose prose-primary md:prose-lg">
    {!! $html !!}
</div>

<div class="p-4 mt-8 bg-zinc-100">
    <script>
        var {{ $dataKey }} = @json($chartData);
    </script>

    <div x-data x-budget="{{ $dataKey }}" class="w-full max-h-screen aspect-[2/3] sm:aspect-[3/2]"></div>
</div>
