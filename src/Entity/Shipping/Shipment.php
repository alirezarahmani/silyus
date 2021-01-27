<?php

declare(strict_types=1);

namespace App\Entity\Shipping;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Shipment as BaseShipment;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_shipment")
 */
class Shipment extends BaseShipment
{

    /** @ORM\Column(type="datetime", nullable=true) */
    private $deliveryDate;

    /**
     * @return \DateTime|null
     */
    public function getDeliveryDate(): ?\DateTime
    {
        return $this->deliveryDate;
    }

    /**
     * @param \DateTime|null $dateTime
     */
    public function setDeliveryDate(?\DateTime $dateTime): void
    {
        $this->deliveryDate = $dateTime;
    }

}
