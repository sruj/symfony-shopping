<?php

namespace Tests\AppBundle\Integration\Command;

use Tests\AppBundle\Integration\IntegrationAbstract;
use AppBundle\Entity\Product;

class RemoveProductTest extends IntegrationAbstract
{
    private $command;

    protected function setUp()
    {
        $this->command = static::$kernel->getContainer()->get('command.remove-product');
    }

    public function testRemovingProduct()
    {
        $product = $this->createProduct();
        static::$em->persist($product);
        static::$em->flush();

        $this->assertTrue($this->productExistsOnDb($product));
        $this->command->setProduct($product)->run();
        $this->assertFalse($this->productExistsOnDb($product));
    }

    protected function tearDown()
    {
        $this->clearProductsTable();
    }
}
