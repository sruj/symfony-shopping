<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\Integration\IntegrationAbstract;

class FindProductByIdTest extends IntegrationAbstract
{
    private $query;

    private $product;

    protected function setUp()
    {
        $this->query = static::$kernel->getContainer()->get('query.find-product-by-id');

        $this->product = $this->createProduct();
        static::$em->persist($this->product);
        static::$em->flush();
    }

    public function testFind()
    {
        $foundProduct = $this->query->find($this->product->id);

        $this->assertEquals($this->product->id, $foundProduct->id);
        $this->assertEquals($this->product->name, $foundProduct->name);
        $this->assertEquals($this->product->description, $foundProduct->description);
        $this->assertEquals($this->product->price, $foundProduct->price);
    }

    protected function tearDown()
    {
        $this->clearProductsTable();
    }
}
