<?php

namespace Test\args;

use PHPUnit\Framework\TestCase;
use Tdd\args\Args;
use Tdd\args\BooleanOptionParser;
use Tdd\args\IntegerOptionParser;
use Tdd\args\StringOptionParser;

class ArgsTest extends TestCase
{
    /**
     * single option
     *     bool -l
     *     integer -p 8080
     *     string -d /usr/logs
     * multiple options: -l -p 8080 -d /usr/logs
     * sad path
     *     bool -l t, -l a t
     *     integer -p, -p 8080 8081
     *     string -d, -d /usr/logs /usr/vars
     * default
     *     bool: false
     *     integer: 0
     *     string: ""
     */

    public function test_set_boolean_option_false_if_flag_not_present()
    {
        $schema = [
            'logging' => [BooleanOptionParser::class, 'l'],
        ];
        $option = Args::parse($schema, []);
        $this->assertFalse($option->logging());
    }

    public function test_set_boolean_option_true_if_flag_present()
    {
        $schema = [
            'logging' => [BooleanOptionParser::class, 'l'],
        ];
        $option = Args::parse($schema, ['-l']);
        $this->assertTrue($option->logging());
    }

    public function test_parse_int_as_option_value()
    {
        $schema = [
            'port' => [IntegerOptionParser::class, 'p'],
        ];
        $option = Args::parse($schema, ['-p', 8080]);
        $this->assertSame(8080, $option->port());
    }

    public function test_get_string_as_option_value()
    {
        $schema = [
            'directory' => [StringOptionParser::class, 'd'],
        ];
        $option = Args::parse($schema, ['-d', '/usr/logs']);
        $this->assertSame('/usr/logs', $option->directory());
    }

    public function test_example_1()
    {
        $schema = [
            'logging' => [BooleanOptionParser::class, 'l'],
            'port' => [IntegerOptionParser::class, 'p'],
            'directory' => [StringOptionParser::class, 'd'],
        ];
        $option = Args::parse($schema, ['-l', '-p', '8080', '-d', '/usr/logs']);
        $this->assertTrue($option->logging());
        $this->assertSame(8080, $option->port());
        $this->assertSame('/usr/logs', $option->directory());
    }
}