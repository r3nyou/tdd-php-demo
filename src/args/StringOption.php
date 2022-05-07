<?php

namespace Tdd\args;

class StringOption
{
    public static function parse(string $flag, array $args): ?string
    {
        foreach ($args as $key => $arg) {
            if ($arg === "-{$flag}") {
                return $args[$key + 1];
            }
        }
        return null;
    }
}