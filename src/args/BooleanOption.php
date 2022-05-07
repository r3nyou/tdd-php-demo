<?php

namespace Tdd\args;

class BooleanOption
{
    public static function parse(string $flag, array $args)
    {
        foreach ($args as $arg) {
            if ($arg === "-{$flag}") {
                return true;
            }
        }
        return false;
    }
}