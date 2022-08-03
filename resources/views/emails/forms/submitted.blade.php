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
<dd>{{ $item['value'] }}</dd>
@endforeach
</dl>
@endcomponent
