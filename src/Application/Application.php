<?php

declare(strict_types=1);

namespace Src\Application;

use Src\Application\Commands\CreateOrderCommand;
use Src\Application\Interfaces\ApplicationInterface;
use Src\Application\Services\EbookOrderService;
use Src\Domain\Entities\Ebook;
use Src\Domain\Repositories\EbookRepository;
use Src\Domain\ValueObjects\OrderId;

final class Application implements ApplicationInterface
{
    private EbookOrderService $ebookOrderService;
    private EbookRepository $ebookRepository;

    public function __construct(EbookOrderService $ebookOrderService, EbookRepository $ebookRepository)
    {
        $this->ebookOrderService = $ebookOrderService;
        $this->ebookRepository = $ebookRepository;
    }

    public function createOrder(CreateOrderCommand $command): OrderId
    {
        return $this->ebookOrderService->createOrder($command);
    }

    /**
     * @return Ebook[]
     */
    public function listAvailableEbooks(): array
    {
        return $this->ebookRepository->findAllAvailable();
    }
}
