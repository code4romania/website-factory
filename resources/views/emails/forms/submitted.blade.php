@component('mail::message')
# @lang('form_submission.mail.intro', ['title' => $form->title])

@if ($stored)

@lang('form_submission.mail.stored')

@component('mail::button', ['url' => route('admin.form_submissions.show', $stored)])
@lang("form_submission.id", ['id' => $stored->id])
@endcomponent

@else
@lang('form_submission.mail.not_stored')
@endif

<dl>
@foreach ($data as $item)
<dt>{{ $item['label'] }}</dt>
<dd>@if (!$item['value'])
&mdash;
@elseif (is_array($item['value']))
@if ($item['type'] === 'file')
<ul>
@foreach ($item['value'] as $file)
<li>
@component('mail::link', [
    'url' => $file['url'],
    'name' => $file['name'],
])
@endcomponent
</li>
@endforeach
</ul>
@else
{{ implode(', ', $item['value']) }}
@endif
@else
{{ $item['value'] }}
@endif
</dd>
@endforeach
</dl>
@endcomponent
