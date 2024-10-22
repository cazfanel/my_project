<?php

declare(strict_types=1);

// src/Infrastructure/Http/Controllers/EbookController.php
namespace Src\Infrastructure\Http\Controllers;

use Src\Application\Interfaces\ApplicationInterface;
use Illuminate\Http\JsonResponse;

class EbookController
{
    private ApplicationInterface $application;

    public function __construct(ApplicationInterface $application)
    {
        $this->application = $application;
    }

    public function listAvailableEbooks(): JsonResponse
    {
        $ebooks = $this->application->listAvailableEbooks();

        // Convertir los objetos Ebook a un formato serializable
        $ebooksArray = array_map(function ($ebook) {
            return [
                'id' => $ebook->getId()->asString(),
                'title' => $ebook->getTitle(),
                'author' => $ebook->getAuthor(),
                // Agrega otros campos según sea necesario
            ];
        }, $ebooks);

        return response()->json($ebooksArray);
    }
}
