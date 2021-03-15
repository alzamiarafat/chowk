<?php

namespace App\Repositories\Orders\Social;
use App\Repositories\Orders\SocialOrderRepository;
use App\Traits\Payments\HasMollie;
use App\Traits\Expedition\HasDelivery;

class DeliveryMollieOrder extends SocialOrderRepository
{
    use HasDelivery;
    use HasMollie;
}