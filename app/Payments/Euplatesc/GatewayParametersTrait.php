<?php

declare(strict_types=1);

namespace App\Payments\Euplatesc;

trait GatewayParametersTrait
{
    public function getEndpointUrl(): string
    {
        return 'https://secure.euplatesc.ro/tdsprocess/tranzactd.php';
    }

    public function setMid($value): self
    {
        return $this->setParameter('mid', $value);
    }

    public function setKey($value): self
    {
        return $this->setParameter('key', $value);
    }

    public function getMid(): mixed
    {
        return $this->getParameter('mid');
    }

    public function getKey(): mixed
    {
        return $this->getParameter('key');
    }

    public function setRecurring(bool $enabled): self
    {
        return $this->setParameter('recurring', $enabled);
    }

    public function getRecurring(): bool
    {
        return (bool) $this->getParameter('recurring');
    }
}
