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

        foreach ($schema as $functionName => $parser) {
            $option->{$functionName} = $parser[0]::parse($parser[1], $args);
        }

        return $option;
    }
}