<?php

require __DIR__ . '/../vendor/autoload.php';

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceManager;

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

// Factory class
class TestAdapterFactory
{
    public function __invoke()
    {
        // Create an instance of the class.
        return new TestAdapter;
    }
}

class TesterFactory
{
    public function __invoke(
        ContainerInterface $container
    ) {
        // Create an instance of the class.
        return new Tester($container->get('ta'));
    }
}


$serviceManager = new ServiceManager();
$serviceManager->setFactory('ta', TestAdapterFactory::class);
$serviceManager->setFactory('tester', TesterFactory::class);


// $object1 = $serviceManager->get('ta');
// $object2 = $serviceManager->get('ta');

$object1 = $serviceManager->create('ta'); // ZF2 build
$object2 = $serviceManager->create('ta'); // ZF2 build

$object3 = $serviceManager->get('tester');

var_dump($object1 === $object2);
var_dump($object1, $object2, $object3);
