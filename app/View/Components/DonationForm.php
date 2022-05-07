<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class DonationForm extends Component
{
    public string $gateway;

    public string $action;

    public bool $recurring = false;

    public Collection $suggestedAmounts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $gateway)
    {
        $this->gateway = $gateway;

        $this->action = localized_route('front.donations.submit');

        $this->recurring = settings("payments.gateways.{$gateway}.recurring", false);

        $this->suggestedAmounts = collect(settings('donations.amounts'))
            ->pluck('amount');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.donation-form');
    }
}
