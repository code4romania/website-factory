<div class="relative overflow-hidden bg-teal-700 shadow-xl rounded-xl">
    <div class="relative px-6 py-24 space-y-8 text-center sm:px-12 md:py-32 lg:py-40">
        <h1 class="text-4xl font-bold text-white sm:text-5xl lg:text-6xl">
            {{ $title }}
        </h1>

        <div class="mx-auto prose text-white max-w-prose sm:prose-lg md:prose-xl">
            {!! $text !!}
        </div>

        @if ($popup)
            <div id="paypal-donate-button-{{ $id }}" class="inline-flex">

                <script>
                    PayPal.Donation.Button({
                        env: 'production',
                        hosted_button_id: @js($button_id),
                        image: {
                            src: 'https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif',
                            alt: 'Donate with PayPal button',
                            title: 'PayPal - The safer, easier way to pay online!',
                        }
                    }).render('#paypal-donate-button-{{ $id }}');
                </script>
            </div>
            @once
                @push('scripts')
                    <script src="https://www.paypalobjects.com/donate/sdk/donate-sdk.js"></script>
                @endpush
            @endonce
        @else
            <form action="https://www.paypal.com/donate" method="post" target="_top" class="inline-flex">
                <input type="hidden" name="hosted_button_id" value="{{ $button_id }}" />
                <img src="https://www.paypal.com/en_US/i/scr/pixel.gif" class="sr-only" alt="">
                <input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                    title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button">
            </form>
        @endif
    </div>
</div>
