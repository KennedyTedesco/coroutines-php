<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Coral\Task;
use Coral\Scheduler;

$scheduler = new Scheduler();

$booksTask = static function () {
    for ($i = 1; $i <= 4; ++$i) {
        echo "Book $i\n";

        yield;
    }
};

$moviesTask = static function () {
    for ($i = 1; $i <= 8; ++$i) {
        echo "Movie $i\n";

        yield;
    }
};

$scheduler->schedule(new Task($booksTask()));
$scheduler->schedule(new Task($moviesTask()));

$scheduler->handle();
