<?php

declare(strict_types=1);

namespace Src\Domain\ValueObjects;

use Ramsey\Uuid\Uuid;

final class OrderId
{
    private string $id;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Uuid::uuid4()->toString();
    }

    public function asString(): string
    {
        return $this->id;
    }

    // Métodos mágicos para facilitar comparaciones
    public function __toString(): string
    {
        return $this->id;
    }

    public function equals(OrderId $other): bool
    {
        return $this->id === $other->asString();
    }
}
