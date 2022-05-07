<?php

namespace Tdd\args;

class StringOptionParser extends IntegerOptionParser
{
    protected static function parseValue($param)
    {
        return (string) $param;
    }
}