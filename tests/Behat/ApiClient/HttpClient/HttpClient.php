<?php

declare(strict_types=1);

namespace App\Tests\Behat\Pho\HttpClient;

use Psr\Http\Message\ResponseInterface;

interface HttpClient
{
    // @todo Header
    public function setHeader(string $name, string|array $value): void;

    // @todo Cookie
    public function setCookie(string $name, string $value);

    // @todo Header[]
    public function setHeaders(array $headers);

    public function get(string $uri): ResponseInterface;

    public function post(string $uri, mixed $content): ResponseInterface;
}