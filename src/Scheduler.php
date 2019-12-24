<?php

declare(strict_types=1);

namespace Coral;

use SplQueue;

final class Scheduler
{
    private $tasks;

    public function __construct()
    {
        $this->tasks = new SplQueue();
    }

    public function schedule(Task $task): void
    {
        $this->tasks->enqueue($task);
    }

    public function handle(): void
    {
        while (! $this->tasks->isEmpty()) {
            /** @var Task $task */
            $task = $this->tasks->dequeue();

            $task->run();
            if (! $task->finished()) {
                $this->schedule($task);
            }
        }
    }
}
