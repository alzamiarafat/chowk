<?php

namespace App\Repositories\Orders\Social;
use App\Repositories\Orders\SocialOrderRepository;
use App\Traits\Payments\HasPayPal;
use App\Traits\Expedition\HasPickup;

class PickupPayPalOrder extends SocialOrderRepository
{
    use HasPickup;
    use HasPayPal;
}