<?php

declare(strict_types=1);

namespace App\Handler\Cart;

use Sylius\ShopApiPlugin\Command\Cart\ChooseShippingMethod;
use Sylius\ShopApiPlugin\Command\CommandInterface;

class ChooseShippingMethodCustom extends ChooseShippingMethod implements CommandInterface
{
    /** @var string|int */
    protected $shipmentIdentifier;

    /** @var string */
    protected $shippingMethod;

    /** @var string */
    protected $orderToken;

    /**
     * @var string|null
     */
    private $deliveryDate;

    /**
     * @param string|int $shipmentIdentifier
     */
    public function __construct(string $orderToken, $shipmentIdentifier, string $shippingMethod, ?string $deliveryDate)
    {
        $this->orderToken = $orderToken;
        $this->shipmentIdentifier = $shipmentIdentifier;
        $this->shippingMethod = $shippingMethod;
        if (!empty($deliveryDate))
        $this->deliveryDate = new \DateTime($deliveryDate);
        parent::__construct($orderToken, $shipmentIdentifier, $shippingMethod);
    }

    public function orderToken(): string
    {
        return $this->orderToken;
    }

    /**
     * @return string|int
     */
    public function shipmentIdentifier()
    {
        return $this->shipmentIdentifier;
    }

    public function shippingMethod(): string
    {
        return $this->shippingMethod;
    }

    /**
     * @return string|null
     */
    public function getDeliveryDate(): ?\DateTime
    {
        return $this->deliveryDate;
    }
}
