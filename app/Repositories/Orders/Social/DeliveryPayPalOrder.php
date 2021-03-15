<?php

namespace App\Repositories\Orders\Social;
use App\Repositories\Orders\SocialOrderRepository;
use App\Traits\Payments\HasPayPal;
use App\Traits\Expedition\HasDelivery;

class DeliveryPayPalOrder extends SocialOrderRepository
{
    use HasDelivery;
    use HasPayPal;
}