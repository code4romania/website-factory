<?php

declare(strict_types=1);

namespace App\Payments\Euplatesc\Message;

use App\Payments\Euplatesc\GatewayParametersTrait;
use Carbon\Carbon;
use Omnipay\Common\Message\AbstractRequest;

class PurchaseRequest extends AbstractRequest
{
    use GatewayParametersTrait;

    public function getData(): array
    {
        $this->validate('amount', 'returnUrl');

        $data = [
            'amount'      => $this->getAmount(),
            'curr'        => $this->getCurrency(),
            'invoice_id'  => $this->getTransactionId(),
            'order_desc'  => $this->getTransactionReference(),
            'merch_id'    => $this->getMid(),
            'timestamp'   => gmdate('YmdHis'),
            'nonce'		  => md5(microtime() . mt_rand()),
        ];

        if ($this->getRecurring()) {
            $data['recurent_freq'] = '28';
            $data['recurent_exp'] = Carbon::today()->addMonths(12)->format('Ymd');
        }

        $data['fp_hash'] = $this->generateMac($data);

        if ($this->getRecurring()) {
            $data['recurent'] = 'Base';
        }

        if ($this->getCard()) {
            $data['fname'] = $this->getCard()->getName();
            $data['add'] = $this->getCard()->getAddress1();
            $data['city'] = $this->getCard()->getCity();
            $data['state'] = $this->getCard()->getState();
            $data['zip'] = $this->getCard()->getPostcode();
            $data['country'] = $this->getCard()->getCountry();
            $data['phone'] = $this->getCard()->getPhone();
            $data['email'] = $this->getCard()->getEmail();
        }

        $data['ExtraData[successurl]'] = $this->getReturnUrl();

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    private function generateMac($data): string
    {
        $str = null;
        foreach ($data as $d) {
            if ($d === null || \strlen($d) == 0) {
                $str .= '-';
            } else {
                $str .= \strlen($d) . $d;
            }
        }

        return hash_hmac('MD5', $str, pack('H*', $this->getKey()));
    }
}
