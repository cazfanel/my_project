<?php

declare(strict_types=1);

namespace Src\Application\Interfaces;

use Src\Application\Commands\CreateOrderCommand;
use Src\Domain\Entities\Ebook;
use Src\Domain\ValueObjects\OrderId;

interface ApplicationInterface
{
    /**
     * @return Ebook[]
     */
    public function listAvailableEbooks(): array;

    public function createOrder(CreateOrderCommand $command): OrderId;
}
