<?php

declare(strict_types=1);

namespace App\Payments\Mobilpay;

use App\Payments\PaymentGateway;

trait GatewayParametersTrait
{
    public function getEndpointUrl(): string
    {
        return PaymentGateway::isTestMode()
            ? 'https://sandboxsecure.mobilpay.ro'
            : 'https://secure.mobilpay.ro';
    }

    public function setSignature($value): self
    {
        return $this->setParameter('signature', $value);
    }

    public function getSignature(): mixed
    {
        return $this->getParameter('signature');
    }

    public function setCertificate($value): self
    {
        return $this->setParameter('certificate', $value);
    }

    public function getCertificate(): mixed
    {
        return $this->getParameter('certificate');
    }

    public function setPrivateKey($value): self
    {
        return $this->setParameter('privateKey', $value);
    }

    public function getPrivateKey(): mixed
    {
        return $this->getParameter('privateKey');
    }
}
