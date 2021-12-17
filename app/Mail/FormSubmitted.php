<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmitted extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public Form $form;

    public array $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Form $form, array $data)
    {
        $this->form = $form;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(__('form.event.submitted'))
            ->markdown('emails.forms.submitted', [
                'form' => $this->form,
                'data' => $this->data,
            ]);
    }
}
