<?php

declare(strict_types=1);

namespace App\Payments\Mobilpay;

use App\Payments\Mobilpay\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

class Gateway extends AbstractGateway
{
    use GatewayParametersTrait;

    public function getName(): string
    {
        return 'Mobilpay';
    }

    public function purchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }
}
