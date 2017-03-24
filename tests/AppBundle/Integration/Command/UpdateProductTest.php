<?php

namespace Tests\AppBundle\Integration\Command;

use Tests\AppBundle\Integration\IntegrationAbstract;

class UpdateProductTest extends IntegrationAbstract
{
    private $command;

    protected function setUp()
    {
        $this->command = static::$kernel->getContainer()->get('command.update-product');
    }

    public function testUpdatingProduct()
    {
        
    }

    protected function tearDown()
    {
        
    }
}
