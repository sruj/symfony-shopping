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

    /**
     * @return Product
     */
    private function createProduct()
    {
        $product = new Product();
        $product->name = 'well-known-name';
        for ($i=0; $i<100; $i++) {
           $product->description .= 'a';    
        }
        $product->price = 1.23;
        return $product;
    }

    /**
     * @param Product $whichProduct
     * @return bool
     */
    private function productExistsOnDb(Product $whichProduct)
    {
        $product = static::$em->getRepository(Product::class)->findOneBy([
            'id' => $whichProduct->id,
        ]);
        if ($product === null)
        {
            return false;
        }
        return true;
    }

    /**
     * @return Product
     */
    private function findProduct(Product $product)
    {
        return static::$em->getRepository(Product::class)->findOneBy([
            'id' => $product->id,
        ]);
    }

    protected function tearDown()
    {
        
    }
}
