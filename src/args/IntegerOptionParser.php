<?php

namespace Tdd\args;

class IntegerOptionParser
{
    public static function parse(string $flag, array $args)
    {
        foreach ($args as $key => $arg) {
            if ($arg === "-{$flag}") {
                return static::parseValue($args[$key + 1]);
            }
        }
        return null;
    }

    protected static function parseValue($param)
    {
        return (int) $param;
    }
}