<?php

declare(strict_types=1);

namespace App\Tests\Behat\Pho\Exception;

use Psr\Http\Client\ClientExceptionInterface;
use RuntimeException;

/**
 * @todo
 */
class ClientException extends RuntimeException implements ClientExceptionInterface
{
}