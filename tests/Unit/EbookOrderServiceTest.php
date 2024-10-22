<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Src\Application\Commands\CreateOrderCommand;
use Src\Application\Services\EbookOrderService;
use Src\Domain\Entities\Ebook;
use Src\Domain\ValueObjects\EbookId;
use Src\Infrastructure\Persistence\InMemory\InMemoryEbookRepository;
use Src\Infrastructure\Persistence\InMemory\InMemoryOrderRepository;

class EbookOrderServiceTest extends TestCase
{
    public function testCreateOrderSuccessfully()
    {
        // Configurar repositorios en memoria
        $ebookRepository = new InMemoryEbookRepository();
        $orderRepository = new InMemoryOrderRepository();

        // Agregar un ebook disponible al repositorio
        $ebook = new Ebook(
            new EbookId(8),
            'Título de Prueba',
            'Autor de Prueba',
            9.99,
            true
        );
        $ebookRepository->save($ebook);

        // Crear instancia del servicio con los repositorios en memoria
        $service = new EbookOrderService($orderRepository, $ebookRepository);

        // Crear comando para crear una orden
        $command = new CreateOrderCommand(8, 1, 'cliente@example.com');

        // Ejecutar el caso de uso
        $orderId = $service->createOrder($command);

        // Verificar que la orden fue creada y almacenada
        $this->assertNotNull($orderId);

        $order = $orderRepository->findById($orderId);
        $this->assertNotNull($order);
        $this->assertEquals('cliente@example.com', $order->getEmail());
        $this->assertEquals(1, $order->getQuantity());
        $this->assertEquals(8, $order->getEbookId()->getId());
    }
}
