<?php

declare(strict_types=1);

namespace App\Tests\Behat\ApiClient;

class Configuration
{
    public function __construct(
        public readonly string $baseUri,
        public readonly bool $debug,
    ) {
    }
}