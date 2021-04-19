<?php

require __DIR__ . '/../vendor/autoload.php';

use Zend\ServiceManager\ServiceManager;

$serviceManager = new ServiceManager();
$serviceManager->setInvokableClass('MyStdClass', stdClass::class);

$object1 = $serviceManager->get('MyStdClass');
$object2 = $serviceManager->get('MyStdClass');

var_dump($object1, $object2);
