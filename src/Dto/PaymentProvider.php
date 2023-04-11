<?php

namespace RSGMSales\Connector\Dto;

class PaymentProvider extends BaseApiModel
{
    public int $id;
    public string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    static function Create(mixed $data): PaymentProvider
    {
        return new PaymentProvider($data->id, $data->attributes->name);
    }

    /**
     * @param mixed $data
     * @return PaymentProvider[]
     */
    static function Deserialize(mixed $data): array
    {
        $items = [];

        foreach ($data as $item) {
            if($item->type !== "paymentProvider") { continue; }
            $items[] = PaymentProvider::create($item);
        }

        return $items;
    }
}
