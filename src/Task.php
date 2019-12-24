<?php

declare(strict_types=1);

namespace Coral;

use Generator;

final class Task
{
    private $coroutine;
    protected $firstYield = true;

    public function __construct(Generator $coroutine)
    {
        $this->coroutine = $coroutine;
    }

    public function run(): void
    {
        if ($this->firstYield) {
            $this->firstYield = false;
            $this->coroutine->current();
        } else {
            $this->coroutine->next();
        }
    }

    public function finished(): bool
    {
        return ! $this->coroutine->valid();
    }
}
