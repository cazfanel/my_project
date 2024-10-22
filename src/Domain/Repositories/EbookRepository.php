<?php

declare(strict_types=1);

namespace Src\Domain\Repositories;

use Src\Domain\Entities\Ebook;

interface EbookRepository
{
    /**
     * @return Ebook[]
     */
    public function findAllAvailable(): array;
}
