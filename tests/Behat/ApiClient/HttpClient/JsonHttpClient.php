<?php

declare(strict_types=1);

namespace App\Tests\Behat\Pho\HttpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

/**
 * @todo Responses COULD implement an internal interface which wraps the ResponseInterface.
 * So we can have responses like: JsonResponse, HtmlResponse, etc etc
 */
class JsonHttpClient implements HttpClient
{
    public function __construct(
        private Client $client,
        private array $headers = [],
        private array $cookies = [],
    ) {
    }

    public function setHeader(string $name, string|array $value): void
    {
        $this->headers[$name] = $value;
    }

    public function setCookie(string $name, string $value)
    {
        $this->cookies[$name] = $value;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    public function get(string $uri): ResponseInterface
    {
        return $this->makeRequest($this->buildRequest('GET', $uri));
    }

    public function post(string $uri, mixed $content): ResponseInterface
    {
        return $this->makeRequest($this->buildRequest('POST', $uri, $content));
    }

    private function makeRequest(Request $request): ResponseInterface
    {
        return $this->client->send($request, [
            'cookies' => CookieJar::fromArray(
                $this->cookies,
                $request->getUri()->getHost(),
            ),
        ]);
    }

    private function buildRequest(
        string $method = 'GET',
        string $uri = '',
        string $body = null,
    ): Request {
        return new Request($method, $uri, $this->headers, $body);
    }
}