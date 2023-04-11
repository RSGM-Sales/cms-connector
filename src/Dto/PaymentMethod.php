<?php

namespace RSGMSales\Connector\Dto;

class PaymentMethod extends BaseApiModel
{
    public int $id;
    public string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    static function Create(mixed $data): PaymentMethod
    {
        return new PaymentMethod($data->id, $data->attributes->name);
    }

    /**
     * @param mixed $data
     * @return PaymentMethod[]
     */
    static function Deserialize(mixed $data): array
    {
        $items = [];

        foreach ($data as $item) {
            if($item->type !== "paymentMethod") { continue; }
            $items[] = PaymentMethod::create($item);
        }

        return $items;
    }
}
