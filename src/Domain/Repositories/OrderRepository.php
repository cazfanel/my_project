<?php

declare(strict_types=1);

namespace Src\Domain\Repositories;

use Src\Domain\Entities\Order;

interface OrderRepository
{
    public function save(Order $order): void;
}
