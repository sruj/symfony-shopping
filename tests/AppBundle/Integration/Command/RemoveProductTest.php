<?php

namespace Tests\AppBundle\Integration\Command;

use Tests\AppBundle\Integration\IntegrationAbstract;
use AppBundle\Entity\Product;

class RemoveProductTest extends IntegrationAbstract
{
    private $command;

    private $product;

    protected function setUp()
    {
        $this->command = static::$kernel->getContainer()->get('command.remove-product');

        $this->product = $this->createProduct();
        static::$em->persist($this->product);
        static::$em->flush();
    }

    public function testRemovingProduct()
    {
        $this->assertTrue($this->productExistsOnDb($this->product));
        $this->command->setProduct($this->product)->run();
        $this->assertFalse($this->productExistsOnDb($this->product));
    }

    protected function tearDown()
    {
        $this->clearProductsTable();
    }
}
