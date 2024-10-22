<?php

declare(strict_types=1);

namespace Src\Application\Services;

use Src\Application\Commands\CreateOrderCommand;
use Src\Domain\Entities\Order;
use Src\Domain\Repositories\OrderRepository;
use Src\Domain\ValueObjects\OrderId;

final class EbookOrderService
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(CreateOrderCommand $command): OrderId
    {
        $order = new Order(
            new OrderId(), // Generamos un nuevo ID de pedido
            $command->ebookId(),
            $command->quantity(),
            $command->email()
        );

        // Guardamos la orden utilizando el repositorio
        $this->orderRepository->save($order);

        return $order->getOrderId();
    }
}
