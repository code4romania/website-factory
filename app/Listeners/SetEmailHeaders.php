<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;
use Symfony\Component\Mime\Address;

class SetEmailHeaders
{
    public string $siteTitle;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->siteTitle = localized_settings('site.title') ?? config('app.name');
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Mail\Events\MessageSending $event
     * @return void
     */
    public function handle(MessageSending $event)
    {
        $event->message
            ->from(new Address(
                config('mail.from.address'),
                $this->siteTitle,
            ))
            ->subject(sprintf(
                '[%s] %s',
                $this->siteTitle,
                $event->message->getSubject()
            ));
    }
}
