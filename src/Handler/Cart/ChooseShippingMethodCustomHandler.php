<?php

declare(strict_types=1);

namespace App\Handler\Cart;

use App\Entity\Shipping\Shipment;
use SM\Factory\FactoryInterface;
use SM\StateMachine\StateMachine;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Core\Model\ShippingMethodInterface;
use Sylius\Component\Core\OrderCheckoutTransitions;
use Sylius\Component\Core\Repository\OrderRepositoryInterface;
use Sylius\Component\Core\Repository\ShipmentRepositoryInterface;
use Sylius\Component\Core\Repository\ShippingMethodRepositoryInterface;
use Sylius\Component\Shipping\Checker\ShippingMethodEligibilityCheckerInterface;
use Sylius\ShopApiPlugin\Command\Cart\ChooseShippingMethod;
use Sylius\ShopApiPlugin\Handler\Cart\ChooseShippingMethodHandler;
use Webmozart\Assert\Assert;

final class ChooseShippingMethodCustomHandler
{
    /** @var OrderRepositoryInterface */
    private $orderRepository;

    /** @var ShippingMethodRepositoryInterface */
    private $shippingMethodRepository;

    /**
     * @var ChooseShippingMethodHandler
     */
    private $chooseShippingMethodHandler;

    public function __construct(OrderRepositoryInterface $orderRepository, ChooseShippingMethodHandler $chooseShippingMethodHandler) {
        $this->chooseShippingMethodHandler = $chooseShippingMethodHandler;
        $this->orderRepository = $orderRepository;
    }

    public function __invoke(ChooseShippingMethodCustom $chooseShippingMethod): void
    {
        call_user_func($this->chooseShippingMethodHandler, $chooseShippingMethod);
        $cart = $this->orderRepository->findOneBy(['tokenValue' => $chooseShippingMethod->orderToken()]);
        /** @var Shipment $shipment */
        dd($cart->getShipments()->toArray());
        $shipment = $cart->getShipments()[$chooseShippingMethod->shipmentIdentifier()];
        if (!empty($chooseShippingMethod->getDeliveryDate())) {
            $shipment->setDeliveryDate($chooseShippingMethod->getDeliveryDate());
        }
    }
}
