<?php

namespace Test\args;

use PHPUnit\Framework\TestCase;

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


    public function test_should()
    {
        $this->markTestSkipped();
        /**
         * Options $options
         */
        $options = Args::parse('l:b,p:d,d:s', '-l', '-p', '8080', '-d', '/usr/logs');
        $options->logging();
        $options->port();
    }
}