<?php

declare(strict_types=1);

namespace Src\Infrastructure\Persistence\InMemory;

use Src\Domain\Entities\Order;
use Src\Domain\Repositories\OrderRepository;
use Src\Domain\ValueObjects\OrderId;

class InMemoryOrderRepository implements OrderRepository
{
    /**
     * @var Order[]
     */
    private array $orders = [];

    public function findById(OrderId $id): ?Order
    {
        foreach ($this->orders as $order) {
            if ($order->getId()->equals($id)) {
                return $order;
            }
        }
        return null;
    }

    public function save(Order $order): void
    {
        // Reemplaza la orden si ya existe
        foreach ($this->orders as $key => $existingOrder) {
            if ($existingOrder->getId()->equals($order->getId())) {
                $this->orders[$key] = $order;
                return;
            }
        }
        // Si no existe, la agrega
        $this->orders[] = $order;
    }

    /**
     * @return Order[]
     */
    public function findAll(): array
    {
        return $this->orders;
    }

    /**
     * Método auxiliar para vaciar el repositorio (útil en pruebas)
     */
    public function clear(): void
    {
        $this->orders = [];
    }
}

