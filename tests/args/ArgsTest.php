<?php

namespace Test\args;

use PHPUnit\Framework\TestCase;
use Tdd\args\Args;
use Tdd\args\BooleanOption;
use Tdd\args\IntegerOption;

class ArgsTest extends TestCase
{
    /**
     * multiple options: -l -p 8080 -d /usr/logs
     * single option
     *     bool -l
     *     integer -p 8080
     *     string -d /usr/logs
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
            'logging' => [BooleanOption::class, 'l'],
        ];
        $option = Args::parse($schema, []);
        $this->assertFalse($option->logging());
    }

    public function test_set_boolean_option_true_if_flag_present()
    {
        $schema = [
            'logging' => [BooleanOption::class, 'l'],
        ];
        $option = Args::parse($schema, ['-l']);
        $this->assertTrue($option->logging());
    }

    public function test_parse_int_as_option_value()
    {
        $schema = [
            'port' => [IntegerOption::class, 'p'],
        ];
        $option = Args::parse($schema, ['-p', 8080]);
        $this->assertSame(8080, $option->port());
    }

    public function test_example_1()
    {
        $this->markTestSkipped();

        $schema = [
            'logging' => [BooleanOption::class, 'l'],
            'port' => [IntegerOption::class, 'p'],
            'directory' => [StringOption::class, 'd'],
        ];
        $option = Args::parse($schema, ['-l', '-p', '8080', '-d', '/usr/logs']);
        $this->assertTrue($option->logging());
        $this->assertSame(8080, $option->port());
        $this->assertSame('/usr/logs', $option->directory());
    }
}