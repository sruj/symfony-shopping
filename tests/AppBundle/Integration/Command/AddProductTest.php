<?php

namespace Tests\AppBundle\Integration\Command;

use Tests\AppBundle\Integration\IntegrationAbstract;
use AppBundle\Entity\Product;

class AddProductTest extends IntegrationAbstract
{
    private $command;

    protected function setUp()
    {
        $this->command = static::$kernel->getContainer()->get('command.add-product');
    }
    
    public function testAddingProduct()
    {
        $product = $this->createProduct();
        $this->command->setProduct($product)
            ->run();

        $this->assertTrue($this->productExistsOnDb($product));
        
        $foundProduct = $this->findProduct($product);
        $this->assertEquals($product->id, $foundProduct->id);
        $this->assertEquals($product->name, $foundProduct->name);
        $this->assertEquals($product->description, $foundProduct->description);
        $this->assertEquals($product->price, $foundProduct->price);
    }

    protected function tearDown()
    {
        $this->clearProductsTable();
    }
}
