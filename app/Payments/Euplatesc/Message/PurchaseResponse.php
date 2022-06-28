<?php

declare(strict_types=1);

namespace App\Payments\Euplatesc\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * 2Checkout Purchase Response.
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $endpoint = 'https://secure.euplatesc.ro/tdsprocess/tranzactd.php';

    protected $testEndpoint = 'https://secure.euplatesc.ro/tdsprocess/tranzactd.php';

    public function isSuccessful(): bool
    {
        return false;
    }

    public function isRedirect(): bool
    {
        return true;
    }

    public function getRedirectUrl()
    {
        $endpoint = $this->getRequest()->getTestMode() ? $this->testEndpoint : $this->endpoint;

        return $endpoint . '?' . http_build_query($this->data);
    }

    public function getRedirectMethod(): string
    {
        return 'POST';
    }

    public function getRedirectData(): array
    {
        return [];
    }
}
