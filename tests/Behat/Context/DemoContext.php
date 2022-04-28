<?php

declare(strict_types=1);

namespace App\Tests\Behat\Context;

use App\Tests\Behat\ApiClient\AuthenticationStrategy\BearerToken;
use App\Tests\Behat\ApiClient\ApiClient;
use Behat\Behat\Context\Context;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use function dd;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
final class DemoContext implements Context
{
    /** @var KernelInterface */
    private $kernel;

    /** @var Response|null */
    private $response;

    private ApiClient $apiClient;

    public function __construct(KernelInterface $kernel, ApiClient $apiClient)
    {
        $this->kernel = $kernel;
        $this->apiClient = $apiClient;
    }

    /**
     * @When a demo scenario sends a request to :path
     */
    public function aDemoScenarioSendsARequestTo(string $path): void
    {
        // @todo POTENTIALLY by default we could use a factory to create an already authenticated instance of ApiClient
        // Ideally we'd only authenticate once per scenario or even suite if possible (although may not be considering our scopes)
        $this->apiClient->authenticate(new BearerToken('abc'));
        $this->apiClient->debug()->get('/'); // ?XDEBUG_SESSION=dev

        // $this->response = $this->kernel->handle(Request::create($path, 'GET'));
        // $response = (new Client())->get('http://nginx?XDEBUG_SESSION=dev');
    }

    /**
     * @Then the response should be received
     */
    public function theResponseShouldBeReceived(): void
    {
        if ($this->response === null) {
            throw new \RuntimeException('No response received');
        }
    }
}
