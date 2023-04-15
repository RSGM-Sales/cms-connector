<?php

namespace RSGMSales\Connector\Dto;

class CreateOrderData
{

    public int $productId;

    /**
     * The amount of mills (/product) that the user would like to order
     * @var float|int
     */
    public float $amount;

    /**
     * The ID of the currency that the user would like to use to pay for their order
     * @var int
     */
    public int $currencyId;
    public string $runescapeName;
    public string $coupon;
    public int $paymentMethodId;

    public function __construct(int $productId, float $amount, int $currencyId, string $runescapeName, int $paymentMethodId, string $coupon = '')
    {
        $this->productId = $productId;
        $this->amount = $amount;
        $this->currencyId = $currencyId;
        $this->runescapeName = $runescapeName;
        $this->coupon = $coupon;
        $this->paymentMethodId = $paymentMethodId;
    }

    public static function create(int $productId, float $amount, int $currencyId, string $runescapeName, int $paymentMethodId, string $coupon = ''): CreateOrderData {
        return new CreateOrderData($productId, $amount, $currencyId, $runescapeName, $paymentMethodId, $coupon);
    }
}
