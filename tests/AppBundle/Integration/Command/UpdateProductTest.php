<?php

namespace Tests\AppBundle\Integration\Command;

use Tests\AppBundle\Integration\IntegrationAbstract;

class UpdateProductTest extends IntegrationAbstract
{
    private $command;

    private $product;

    private $newProductName = 'new-name';

    protected function setUp()
    {
        $this->command = static::$kernel->getContainer()->get('command.update-product');

        $this->product = $this->createProduct();
        static::$em->persist($this->product);
        static::$em->flush();
    }

    public function testUpdatingProduct()
    {
        $this->assertTrue($this->productExistsOnDb($this->product));
        $this->assertEquals($this->product->name, $this->dummyProductName);

        $this->product->name = $this->newProductName;
        $this->command->setProduct($this->product)->run();
        $this->assertTrue($this->productExistsOnDb($this->product));

        $updatedProduct = $this->findProduct($this->product);
        $this->assertEquals($updatedProduct->name, $this->newProductName);
    }

    protected function tearDown()
    {
        $this->clearProductsTable();
    }
}
