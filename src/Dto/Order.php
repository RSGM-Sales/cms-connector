<?php

namespace RSGMSales\Connector\Dto;

class Order extends BaseApiModel
{
    public int $id;
    public string $date;
    public float $amount;
    public float $total;
    public string $status;
    public Currency $currency;
    public Product $product;

    public function __construct(int $id, string $date, float $amount, float $total, string $status, Currency $currency)
    {
        $this->id = $id;
        $this->date = $date;
        $this->amount = $amount;
        $this->total = $total;
        $this->status = $status;
        $this->currency = $currency;
    }

    static function Create(mixed $data): Order
    {
        return new Order($data->id, $data->attributes->date, $data->attributes->amount, $data->attributes->total, $data->attributes->status, Currency::Create($data->relationships->currency));
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
