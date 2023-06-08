<?php

namespace RSGMSales\Connector\Dto;

class CreateOrderData
{
    public string $inGameName;

    /**
     * The URL to which the user should be redirected after the payment flow has been completed (by default this should be their order history page)
     * @var string
     */
    public string $siteRedirectUrl;

    /**
     * The ID of the currency that the user would like to use to pay for their order
     * @var int
     */
    public int $currencyId;
    public int $paymentProviderPaymentMethodId;
    public int $productId;

    /**
     * The amount of product (mills) that the user would like to order
     * @var float|int
     */
    public float $amount;
    public string $coupon;
    public array $metaData;

    public function __construct(string $inGameName, string $siteRedirectUrl, int $currencyId, int $paymentProviderPaymentMethodId, int $productId, float $amount, string $coupon = '', array $metaData = [])
    {
        $this->inGameName = $inGameName;
        $this->siteRedirectUrl = $siteRedirectUrl;
        $this->currencyId = $currencyId;
        $this->paymentProviderPaymentMethodId = $paymentProviderPaymentMethodId;
        $this->productId = $productId;
        $this->amount = $amount;
        $this->coupon = $coupon;
        $this->metaData = $metaData;
    }

    public static function create(string $inGameName, string $siteRedirectUrl, int $currencyId, int $paymentProviderPaymentMethodId, int $productId, float $amount, string $coupon = '', array $metaData = []): CreateOrderData {
        return new CreateOrderData($inGameName, $siteRedirectUrl, $currencyId, $paymentProviderPaymentMethodId, $productId, $amount, $coupon, $metaData);
    }
}
