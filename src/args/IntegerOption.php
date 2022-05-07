<?php

namespace Tdd\args;

class IntegerOption
{
    public static function parse(string $flag, array $args): ?int
    {
        foreach ($args as $key => $arg) {
            if ($arg === "-{$flag}") {
                return $args[$key + 1];
            }
        }
        return null;
    }
}