<?php

declare(strict_types=1);

namespace App\Tests\Behat\Pho\HttpClient;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class KernelClient // implements HttpClient
{
    public function __construct(
        private HttpKernelInterface $kernel
    ) {
    }

    public function setHeader(string $name, array|string $value): void
    {
        // TODO: Implement setHeader() method.
    }

    public function setCookie(string $name, string $value)
    {
        // TODO: Implement setCookie() method.
    }

    public function setHeaders(array $headers)
    {
        // TODO: Implement setHeaders() method.
    }

    public function get(string $uri): ResponseInterface
    {
        // @todo
        // $request = new Request(, 'GET');
        // $request->
    }

    public function post(string $uri, mixed $content): ResponseInterface
    {
        // TODO: Implement post() method.
    }

    protected function makeRequest(Request $request): ResponseInterface
    {
        // @todo wouldn't need this adapter if we implemented our own interface
        return KernelClientResponseAdapter::adapt($this->kernel->handle($request));
    }
}