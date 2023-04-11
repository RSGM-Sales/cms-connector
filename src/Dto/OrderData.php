<?php

namespace RSGMSales\Connector\Dto;

class OrderData
{

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

    public function __construct(float $amount, int $currencyId, string $runescapeName, int $paymentMethodId, string $coupon = '',)
    {
        $this->amount = $amount;
        $this->currencyId = $currencyId;
        $this->runescapeName = $runescapeName;
        $this->coupon = $coupon;
        $this->paymentMethodId = $paymentMethodId;
    }
}
