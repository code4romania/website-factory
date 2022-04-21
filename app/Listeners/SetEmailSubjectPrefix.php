<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Mail\Events\MessageSending;

class SetEmailSubjectPrefix
{
    public string $prefix;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->prefix = localized_settings('site.title') ?? config('app.name');
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Mail\Events\MessageSending $event
     * @return void
     */
    public function handle(MessageSending $event)
    {
        $event->message->subject(sprintf(
            '[%s] %s',
            $this->prefix,
            $event->message->getSubject()
        ));
    }
}
