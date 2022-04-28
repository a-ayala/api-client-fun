<?php

declare(strict_types=1);

namespace App\Tests\Behat\ApiClient\Exception;

use Psr\Http\Client\ClientExceptionInterface;
use RuntimeException;

/**
 * @todo
 */
class ClientException extends RuntimeException implements ClientExceptionInterface
{
}