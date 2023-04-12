<?php

namespace RSGMSales\Connector\Dto;

class PaymentOption extends BaseApiModel
{
    public int $id;
    public PaymentMethod $paymentMethod;
    public PaymentProvider $paymentProvider;
    public float $fee;

    public function __construct(int $id, PaymentMethod $paymentMethod, PaymentProvider $paymentProvider, $fee = 0)
    {
        $this->id = $id;
        $this->paymentMethod = $paymentMethod;
        $this->paymentProvider = $paymentProvider;
        $this->fee = $fee;
    }

    static function Create(mixed $data): PaymentOption
    {
        return new PaymentOption($data->id, PaymentMethod::Create($data->relationships->paymentMethod), PaymentProvider::Create($data->relationships->paymentProvider), $data->attributes->fee);
    }

    static function Deserialize(mixed $data): array
    {
        $items = [];

        foreach ($data as $item) {
            $items[] = PaymentOption::create($item);
        }

        return $items;
    }
}
