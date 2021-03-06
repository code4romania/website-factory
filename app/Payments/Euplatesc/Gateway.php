<?php

declare(strict_types=1);

namespace App\Payments\Euplatesc;

use App\Payments\Euplatesc\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

class Gateway extends AbstractGateway
{
    use GatewayParametersTrait;

    public function getName(): string
    {
        return 'Euplatesc';
    }

    public function purchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }
}
