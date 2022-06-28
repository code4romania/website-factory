<?php

declare(strict_types=1);

namespace App\Payments\Euplatesc;

use App\Payments\Euplatesc\Message\PurchaseRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;

class Gateway extends AbstractGateway
{
    use GatewayParametersTrait;

    protected $endpointLive = 'https://secure.euplatesc.ro/tdsprocess/tranzactd.php';

    protected $endpointSandbox = 'https://secure.euplatesc.ro/tdsprocess/tranzactd.php';

    public function getName(): string
    {
        return 'Euplatesc';
    }

    public function isActive(): bool
    {
        if ($this->getMid() && $this->getKey()) {
            return true;
        }

        return false;
    }

    public function purchase(array $parameters = []): RequestInterface
    {
        $parameters['endpointUrl'] = $this->getEndpointUrl();

        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    public function completePurchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(CompletePurchaseRequest::class, $parameters);
    }

    public function serverCompletePurchase(array $parameters = []): RequestInterface
    {
        return $this->createRequest(ServerCompletePurchaseRequest::class, $parameters);
    }

    public function getDefaultParameters(): array
    {
        return [
            'testMode' => true,
            'mid'      => $this->getMid(),
            'key'      => $this->getKey(),
        ];
    }

    public function getEndpointUrl(): string
    {
        $defaultUrl = $this->getTestMode() === false
            ? $this->endpointLive
            : $this->endpointSandbox;

        return $this->parameters->get('endpointUrl', $defaultUrl);
    }

    public function setTestMode($value): self
    {
        $this->parameters->remove('endpointUrl');

        return parent::setTestMode($value);
    }
}
