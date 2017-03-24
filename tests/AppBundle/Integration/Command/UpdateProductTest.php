<?php

namespace Tests\AppBundle\Integration\Command;

use Tests\AppBundle\Integration\IntegrationAbstract;

class UpdateProductTest extends IntegrationAbstract
{
    private $command;

    private $newProductName = 'new-name';

    protected function setUp()
    {
        $this->command = static::$kernel->getContainer()->get('command.update-product');
    }

    public function testUpdatingProduct()
    {
        $product = $this->createProduct();
        static::$em->persist($product);
        static::$em->flush();

        $this->assertTrue($this->productExistsOnDb($product));
        $this->assertEquals($product->name, $this->dummyProductName);
        $product->name = $this->newProductName;
        $this->command->setProduct($product)->run();
        $this->assertTrue($this->productExistsOnDb($product));

        $updatedProduct = $this->findProduct($product);
        $this->assertEquals($updatedProduct->name, $this->newProductName);
    }

    protected function tearDown()
    {
        $this->clearProductsTable();
    }
}
