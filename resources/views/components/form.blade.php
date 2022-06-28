@props(['form'])


<div {{ $attributes }}>
    @if (session()->has('success'))
        <div class="p-4 rounded-md bg-green-50">
            <div class="flex">
                <x-ri-mail-send-fill class="w-5 h-5 text-green-400 shrink-0" />

                <p class="ml-3 text-sm font-medium text-green-800">
                    {{ session()->get('success') }}
                </p>
            </div>
        </div>
    @else
        <form action="{{ localized_route('front.forms.submit', ['form' => $form]) }}" method="post">
            <x-blocks :model="$form" prefix="form" :container="false" />

            <div class="flex mt-8 lg:mt-12">
                @csrf

                <x-button
                    type="submit"
                    class="items-center justify-center block w-full font-semibold text-white border border-transparent sm:w-auto sm:inline-block bg-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary"
                    size="lg">
                    @lang('form.action.submit')
                </x-button>
            </div>
        </form>
    @endif
</div>
