<?php

declare(strict_types=1);

namespace App\Tests\Behat\ApiClient\AuthenticationStrategy;

use App\Tests\Behat\ApiClient\HttpClient\HttpClient;

interface AuthenticationStrategy
{
    public function authenticate(HttpClient $client): void;
}
