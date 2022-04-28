<?php

declare(strict_types=1);

namespace App\Tests\Behat\Pho\AuthenticationStrategy;

use App\Tests\Behat\Pho\HttpClient\HttpClient;

interface AuthenticationStrategy
{
    public function authenticate(HttpClient $client): void;
}
