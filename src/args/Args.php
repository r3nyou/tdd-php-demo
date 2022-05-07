<?php

namespace Tdd\args;

class Args
{
    public static function parse(array $schema, array $args)
    {
        $option = new class () {
            public function __call($methodName, $arguments) {
                return $this->{$methodName};
            }
        };

        foreach ($schema as $functionName => $callable) {
            $option->{$functionName} = $callable($args);
        }

        return $option;
    }
}