<?php

namespace App\Repositories\Orders\Local;
use App\Repositories\Orders\LocalOrderRepository;
use App\Traits\Payments\HasPayStack;
use App\Traits\Expedition\HasDineIn;

class DineinPayStackOrder extends LocalOrderRepository
{
    use HasDineIn;
    use HasPayStack;
}