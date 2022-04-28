<?php

declare(strict_types=1);

namespace App\Tests\Behat\Pho;

class ConfigurationFactory
{
    public static function create(): Configuration
    {
        // @todo get from env
        return new Configuration('http://nginx', true);
    }
}