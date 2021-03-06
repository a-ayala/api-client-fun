<?php

declare(strict_types=1);

namespace App\Tests\Behat\ApiClient;

use App\Tests\Behat\ApiClient\AuthenticationStrategy\AuthenticationStrategy;
use App\Tests\Behat\ApiClient\HttpClient\HttpClient;
use Psr\Http\Message\ResponseInterface;

/**
 * @todo Thought: rather than standard get/post/etc methods ApiClient could act more like an SDK and instead understand the structure of what it's consuming.
 * We'd need a "PhoCore" to do that however, then extend it to implement methods.
 *
 * @todo If we adopt this strategy then should ApiClient really make HTTP verb based requests?
 * I.e. ApiClient could just expose a "go" / "visit" / "fetch" method which will let the Concrete decide HOW to send it
 * If this were the case then ApiClient could infact mock requests from anything our system exposes an adapter for.
 */
class ApiClient
{
    public function __construct(
        private HttpClient $httpClient,
        private Configuration $configuration
    ) {
    }

    public function get(string $path): ResponseInterface
    {
        return $this->httpClient->get($this->uri($path));
    }

    public function authenticate(AuthenticationStrategy $authenticator): self
    {
        $authenticator->authenticate($this->httpClient);

        return $this;
    }

    public function setClient(HttpClient $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @todo BIG NO NO but perhaps with some open/closed pattern we could inject headers dynamically.
     * Potentially with a service factory or something... I.e. the factory, if in a dev environment, could create ApiClient and set the XDEBUG header
     */
    public function debug(): self
    {
        $this->httpClient->setCookie('XDEBUG_SESSION', 'dev');

        return $this;
    }

    private function uri(string $path): string
    {
        return sprintf(
            "%s/%s",
            $this->configuration->baseUri,
            str_starts_with($path, '/') ? ltrim($path, '/') : $path,
        );
    }
}
