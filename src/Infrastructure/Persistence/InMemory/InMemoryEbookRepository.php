<?php

declare(strict_types=1);

namespace Src\Infrastructure\Persistence\InMemory;

use Src\Domain\Entities\Ebook;
use Src\Domain\Repositories\EbookRepository;
use Src\Domain\ValueObjects\EbookId;

class InMemoryEbookRepository implements EbookRepository
{
    /**
     * @var Ebook[]
     */
    private array $ebooks = [];

    public function __construct(array $initialData = [])
    {
        foreach ($initialData as $ebook) {
            $this->save($ebook);
        }
    }

    public function findById(EbookId $id): ?Ebook
    {
        foreach ($this->ebooks as $ebook) {
            if ($ebook->getId()->equals($id)) {
                return $ebook;
            }
        }
        return null;
    }

    /**
     * @return Ebook[]
     */
    public function findAllAvailable(): array
    {
        $ebook1 = new Ebook(
            new EbookId(1),
        'Título de Prueba',
        'Autor de Prueba',
        9.99,
        true
        );
        $ebook2 = new Ebook(
            new EbookId(2),
            'Título de Prueba 2',
            'Autor de Prueba 2',
            8.99,
            true
        );
        $this->ebooks[] = $ebook1;
        $this->ebooks[] = $ebook2;
        return array_filter($this->ebooks, function (Ebook $ebook) {
            return $ebook->isAvailable();
        });
    }

    public function save(Ebook $ebook): void
    {
        // Reemplaza el ebook si ya existe
        foreach ($this->ebooks as $key => $existingEbook) {
            if ($existingEbook->getId()->equals($ebook->getId())) {
                $this->ebooks[$key] = $ebook;
                return;
            }
        }
        // Si no existe, lo agrega
        $this->ebooks[] = $ebook;
    }

    public function remove(EbookId $id): void
    {
        foreach ($this->ebooks as $key => $ebook) {
            if ($ebook->getId()->equals($id)) {
                unset($this->ebooks[$key]);
                $this->ebooks = array_values($this->ebooks);
                return;
            }
        }
    }

    /**
     * Método auxiliar para vaciar el repositorio (útil en pruebas)
     */
    public function clear(): void
    {
        $this->ebooks = [];
    }
}
