<?php

namespace RSGMSales\Connector\Dto;

class Order extends BaseApiModel
{
    public float $amount;
    public string $status;
    public float $orderNumber;
    public string $currencyIsoCode;
    public string $currencyName;
    public string $providerName;
    public string $providerFee;
    public string $couponCode;
    public string $couponAmount;
    public string $createdAt;

    public function __construct(
        float  $amount,
        string $status,
        float  $orderNumber,
        string  $currencyIsoCode,
        string $currencyName,
        string $providerName,
        string $providerFee,
        string $couponCode,
        string $couponAmount,
        string $createdAt,
    )
    {
        $this->amount = $amount;
        $this->status = $status;
        $this->orderNumber = $orderNumber;
        $this->currencyIsoCode = $currencyIsoCode;
        $this->currencyName = $currencyName;
        $this->providerName = $providerName;
        $this->providerFee = $providerFee;
        $this->couponCode = $couponCode;
        $this->couponAmount = $couponAmount;
        $this->createdAt = $createdAt;
    }

    static function Create(mixed $data): Order
    {
        return new Order(
            $data->attributes->amount,
            $data->attributes->status,
            $data->attributes->orderNumber,
            $data->attributes->currencyIsoCode,
            $data->attributes->currencyName,
            $data->attributes->providerName,
            $data->attributes->providerFee,
            $data->attributes->couponCode,
            $data->attributes->couponAmount,
            $data->attributes->createdAt,
        );
    }

    /**
     * @param mixed $data
     * @return Order[]
     */
    static function Deserialize(mixed $data): array
    {
        $items = [];

        foreach ($data as $item) {
            $items[] = Order::create($item);
        }

        return $items;
    }
}
