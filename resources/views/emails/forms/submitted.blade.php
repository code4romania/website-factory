<dl>

@foreach ($data as $item)
<div>
<dt>{{ $item['label'] }}</dt>
<dd>{{ $item['value'] }}</dd>
</div>
@endforeach

</dl>
