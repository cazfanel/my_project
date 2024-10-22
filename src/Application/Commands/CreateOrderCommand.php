<?php

declare(strict_types=1);

namespace Src\Application\Commands;

use Src\Domain\ValueObjects\EbookId;

final class CreateOrderCommand
{
    private EbookId $ebookId;
    private int $quantity;
    private string $email;

    public function __construct($ebookId, $quantity, $email)
    {
        $this->ebookId = new EbookId($ebookId);
        $this->quantity = $quantity;
        $this->email = $email;
    }

    public function ebookId(): EbookId
    {
        return $this->ebookId;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function email(): string
    {
        return $this->email;
    }
}
