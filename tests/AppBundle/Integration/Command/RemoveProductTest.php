<?php

namespace Tests\AppBundle\Integration\Command;

use Tests\AppBundle\Integration\IntegrationAbstract;

class RemoveProductTest extends IntegrationAbstract
{
    private $command;

    protected function setUp()
    {
        $this->command = static::$kernel->getContainer()->get('command.remove-product');
    }

    public function testRemovingProduct()
    {
        
    }

    protected function tearDown()
    {
        
    }
}
