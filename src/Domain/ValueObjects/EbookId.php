<?php

declare(strict_types=1);

namespace Src\Domain\ValueObjects;

final class EbookId
{
    private int $id;

    public function __construct(int $id = 0)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function equals(EbookId $other): bool
    {
        return $this->id === $other->getId();
    }
}
