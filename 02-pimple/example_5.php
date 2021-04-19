<?php

require __DIR__ . '/../vendor/autoload.php';

use Pimple\Container;

$ioc = new Container();

$ioc['sum'] = $ioc->protect(function ($a, $b) {
    return $a + $b;
});

$ioc['multiplicator'] = 10;

$sum = $ioc['sum'];

var_dump($sum(1, 2) * $ioc['multiplicator']);
