<?php

namespace Test\args;

use PHPUnit\Framework\TestCase;
use Tdd\args\Args;

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

    public function test_should_call_parser_in_schema_to_build_option()
    {
        $schema = [
            'logging' => function ($args) { return $args; },
            'port' => function ($args) { return $args; },
        ];
        $option = Args::parse($schema, ['args']);
        $this->assertSame(['args'], $option->logging());
        $this->assertSame(['args'], $option->port());
    }

    public function test_example_1()
    {
        $this->markTestSkipped();

        $schema = [
            'logging' => BooleanOption::parse('l'),
            'port' => IntegerOption::parse('p'),
            'directory' => StringOption::parse('d'),
        ];
        $option = Args::parse($schema, ['-l', '-p', '8080', '-d', '/usr/logs']);
        $this->assertTrue($option->logging());
        $this->assertSame(8080, $option->port());
        $this->assertSame('/usr/logs', $option->directory());
    }
}