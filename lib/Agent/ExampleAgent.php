<?php

namespace Vendor\Module\Agent;

class ExampleAgent extends AbstractAgent
{
    private const NAME = '\\Vendor\\Module\\Agent\\ExampleAgent::run();';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getInterval(): int
    {
        return 600;
    }

    public static function run(): string
    {
        // code here

        return self::NAME;
    }
}
