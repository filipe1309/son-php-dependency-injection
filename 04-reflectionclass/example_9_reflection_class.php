<?php

namespace MyNamespace {

    class Dependency
    {
        public function showMe()
        {
            return 'Class dependency has been used';
        }
    }

    $class = new \ReflectionClass('MyNamespace\Dependency');
    var_dump($class->getMethods());
    $object = $class->newInstance();
    var_dump($object->showMe());
};
