<?php

declare(strict_types=1);

namespace Src\Infrastructure\Http\Controllers;

use Src\Application\Interfaces\ApplicationInterface;
use Src\Application\Commands\CreateOrderCommand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController
{
    private ApplicationInterface $application;

    public function __construct(ApplicationInterface $application)
    {
        $this->application = $application;
    }

    public function createOrder(Request $request): JsonResponse
    {
        // Validar la solicitud (puedes crear una clase FormRequest para esto)
        $validatedData = $request->validate([
            'ebook_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'email' => 'required|email',
        ]);

        $command = new CreateOrderCommand(
            $validatedData['ebook_id'],
            $validatedData['quantity'],
            $validatedData['email']
        );

        $orderId = $this->application->createOrder($command);

        return response()->json(['order_id' => $orderId->asString()], 201);
    }
}

