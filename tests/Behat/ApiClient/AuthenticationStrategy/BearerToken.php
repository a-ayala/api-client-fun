<?php

declare(strict_types=1);

namespace App\Tests\Behat\ApiClient\AuthenticationStrategy;

use App\Tests\Behat\ApiClient\HttpClient\HttpClient;

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
