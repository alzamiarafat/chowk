<?php

namespace App\Repositories\Orders\Social;
use App\Repositories\Orders\SocialOrderRepository;
use App\Traits\Payments\HasMollie;
use App\Traits\Expedition\HasPickup;

class PickupMollieOrder extends SocialOrderRepository
{
    use HasPickup;
    use HasMollie;
}