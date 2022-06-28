<?php

declare(strict_types=1);

namespace App\Payments\Euplatesc;

/**
 * Trait HasIntegrationParametersTrait.
 */
trait GatewayParametersTrait
{
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

    public function setExtraData($value): self
    {
        return $this->setParameter('ExtraData', $value);
    }

    public function getExtraData(): mixed
    {
        return $this->getParameter('ExtraData');
    }
}
