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
    public function __construct(TestAdapter $adapter, $message = 'Default value')
    {
        $adapter->runTest($message);
    }
}

$testAdapter = (new \SON\Di\Resolver)->resolveClass('TestAdapter');
$testAdapter->runTest('Test Resolver');

$tester = (new \SON\Di\Resolver)->resolveClass('Tester');
$tester = (new \SON\Di\Resolver)->resolveClass('Tester', ['message' => 'Test run!!!']);



$func = function (Tester $test, TestAdapter $testAdapter, $message = 'Closure test') {
    var_dump($testAdapter->runTest($message));
};

(new \SON\Di\Resolver)->resolveFunction($func);
(new \SON\Di\Resolver)->resolveFunction($func, ['message' => 'Closure test with DI']);
