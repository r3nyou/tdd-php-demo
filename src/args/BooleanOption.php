<?php

namespace Tdd\args;

class BooleanOption
{
    public static function parse(string $flag, array $args): bool
    {
        foreach ($args as $arg) {
            if ($arg === "-{$flag}") {
                return true;
            }
        }
        return false;
    }
}