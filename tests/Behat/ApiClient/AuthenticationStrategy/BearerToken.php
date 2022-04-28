<?php

declare(strict_types=1);

namespace App\Tests\Behat\Pho\AuthenticationStrategy;

use App\Tests\Behat\Pho\HttpClient\HttpClient;

class BearerToken implements AuthenticationStrategy
{
    public function __construct(
        private string $token
    ) {
    }

    public function authenticate(HttpClient $client): void
    {
        $client->setHeader("Authorization", "Bearer $this->token");
    }
}
