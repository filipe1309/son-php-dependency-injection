<?php

require __DIR__ . '/../vendor/autoload.php';

class TestAdapter
{
    public function __construct()
    {
        var_dump(TestAdapter::class . '::__construct()');
    }

    public function runTest($message)
    {
        var_dump($message);
    }
}

class Tester
{
    public function __construct(TestAdapter $adapter)
    {
        $adapter->runTest('Test run!!!');
    }
}

$testAdapter = (new \SON\Di\Resolver)->resolveClass('TestAdapter');
$testAdapter->runTest('Test Resolver');

$tester = (new \SON\Di\Resolver)->resolveClass('Tester');
