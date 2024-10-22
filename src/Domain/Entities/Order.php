<?php

declare(strict_types=1);

namespace Src\Domain\Entities;

use DateTimeImmutable;
use Src\Domain\ValueObjects\EbookId;
use Src\Domain\ValueObjects\OrderId;

final class Order
{
    private OrderId $id;
    private EbookId $ebookId;
    private int $quantity;
    private string $email;
    private DateTimeImmutable $createdAt;

    public function __construct(OrderId $id, EbookId $ebookId, int $quantity, string $email)
    {
        $this->id = $id;
        $this->ebookId = $ebookId;
        $this->quantity = $quantity;
        $this->email = $email;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): OrderId
    {
        return $this->id;
    }

    public function getEbookId(): EbookId
    {
        return $this->ebookId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}
