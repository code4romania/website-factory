<script>
    var {{ $dataKey }} = @json($chartData);
</script>

<div class="p-4 bg-zinc-100">
    <div x-data x-budget="{{ $dataKey }}" class="w-full max-h-screen aspect-[2/3] sm:aspect-[3/2]"></div>
</div>
