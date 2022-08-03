<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Form;
use App\Models\FormSubmission;
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

    public ?FormSubmission $stored;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Form $form, array $data, ?FormSubmission $stored)
    {
        $this->form = $form;
        $this->data = $data;
        $this->stored = $stored;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->form->title)
            ->markdown('emails.forms.submitted', [
                'form'   => $this->form,
                'data'   => $this->data,
                'stored' => $this->stored,
            ]);
    }
}
