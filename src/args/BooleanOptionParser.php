<?php

namespace Tdd\args;

class BooleanOptionParser
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