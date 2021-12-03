@if (config('app.debug'))
    <div class="p-4 text-red-700 border-l-4 border-red-400 bg-red-50">
        Missing block view at <code class="font-bold">{{ $path }}</code>
    </div>
@endif
