<?php

declare(strict_types=1);

namespace App\Tests\Behat\Pho\HttpClient;

use GuzzleHttp\Psr7\Response as Psr7Response;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class KernelClientResponseAdapter
{
    public static function adapt(Response $response): ResponseInterface
    {
        // @todo reason?
        return new Psr7Response(
            $response->getStatusCode(),
            $response->headers->all(),
            $response->getContent(),
            $response->getProtocolVersion(),
            ''
        );
    }
}