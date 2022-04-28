<?php

declare(strict_types=1);

namespace Tests\Behat;

use Behat\Behat\Context\Context;
use Behat\Pho\Pho;
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

    private Pho $pho;

    public function __construct(KernelInterface $kernel, Pho $pho)
    {
        $this->kernel = $kernel;
        $this->pho = $pho;
    }

    /**
     * @When a demo scenario sends a request to :path
     */
    public function aDemoScenarioSendsARequestTo(string $path): void
    {
        // $this->response = $this->kernel->handle(Request::create($path, 'GET'));
        $response = (new Client())->get('http://nginx?XDEBUG_SESSION=dev');

        dd(json_decode($response->getBody()->getContents()));
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
