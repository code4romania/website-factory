<?php

declare(strict_types=1);

namespace App\Payments\Mobilpay\Message;

use App\Payments\Mobilpay\GatewayParametersTrait;
use Netopia\Payment\Address;
use Netopia\Payment\Invoice;
use Netopia\Payment\Request\Card;
use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    use GatewayParametersTrait;

    public function getData(): array
    {
        $this->validate('amount');

        $request = new Card();

        $request->signature = $this->getSignature();
        $request->orderId = $this->getTransactionId();
        $request->returnUrl = $this->getReturnUrl();
        $request->params = $this->getParameter('params') ?: [];

        $request->invoice = new Invoice();
        $request->invoice->amount = $this->getAmount();
        $request->invoice->currency = $this->getCurrency();
        $request->invoice->details = $this->getTransactionReference();

        $address = new Address();

        $address->type = 'person'; // person or company
        $address->firstName = $this->getCard()->getFirstName();
        $address->lastName = $this->getCard()->getLastName();
        $address->country = $this->getCard()->getCountry();
        $address->county = $this->getCard()->getState();
        $address->city = $this->getCard()->getCity();
        $address->zipCode = $this->getCard()->getPostcode();
        $address->address = $this->getCard()->getAddress1();
        $address->email = $this->getCard()->getEmail();
        $address->mobilePhone = $this->getCard()->getPhone();

        $request->invoice->setBillingAddress($address);

        $request->encrypt($this->getCertificate());

        $data = [
            'env_key' => $request->getEnvKey(),
            'data' => $request->getEncData(),
        ];

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
