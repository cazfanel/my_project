<?php

declare(strict_types=1);

namespace Src\Domain\Entities;

use Src\Domain\ValueObjects\EbookId;

final class Ebook
{
    private EbookId $id;
    private string $title;
    private string $author;
    private float $price;
    private bool $available;

    public function __construct(EbookId $id, string $title, string $author, float $price, bool $available = true)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
        $this->available = $available;
    }

    public function getId(): EbookId
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }
}
