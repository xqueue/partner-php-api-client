<?php

namespace Xqueue\MaileonPartnerApiClient\Tests;

use Dotenv\Dotenv;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    public function __construct(string $name)
    {
        parent::__construct($name);

        $dotenv = Dotenv::createUnsafeImmutable('/app/');
        $dotenv->load();
    }
}
