<?php

declare(strict_types=1);

namespace Src\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Application\Application;
use Src\Application\Interfaces\ApplicationInterface;
use Src\Application\Services\EbookOrderService;
use Src\Domain\Repositories\EbookRepository;
use Src\Domain\Repositories\OrderRepository;
use Src\Infrastructure\Persistence\InMemory\InMemoryEbookRepository;
use Src\Infrastructure\Persistence\InMemory\InMemoryOrderRepository;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EbookRepository::class, InMemoryEbookRepository::class);
        $this->app->bind(OrderRepository::class, InMemoryOrderRepository::class);

        // Registro de EbookOrderService
        $this->app->singleton(EbookOrderService::class, function ($app) {
            return new EbookOrderService(
                $app->make(OrderRepository::class),
                $app->make(EbookRepository::class)
            );
        });

        // Registro de ApplicationInterface
        $this->app->singleton(ApplicationInterface::class, function ($app) {
            return new Application(
                $app->make(EbookOrderService::class),
                $app->make(EbookRepository::class)
            );
        });
    }

    public function boot()
    {
        //
    }
}
