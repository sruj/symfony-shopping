<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\Integration\IntegrationAbstract;

class ItemsPerPageTest extends IntegrationAbstract
{
    private $query;

    protected function setUp()
    {
        $this->query = static::$kernel->getContainer()->get('query.get-product-list');

        $this->createThirtyProducts();
    }

    public function testItemsPerPage_3()
    {
        $this->query->itemsPerPage = 3;
        $pageOne = $this->query->getList(1);
        $this->assertEquals(count($pageOne), 3);

        $pageTwo = $this->query->getList(2);
        $this->assertEquals(count($pageTwo), 3);

        $pageTen = $this->query->getList(10);
        $this->assertEquals(count($pageTen), 3);
    }

    public function testItemsPerPage_7()
    {
        $this->query->itemsPerPage = 7;
        $pageOne = $this->query->getList(1);
        $this->assertEquals(count($pageOne), 7);

        $pageTwo = $this->query->getList(2);
        $this->assertEquals(count($pageTwo), 7);

        $pageFive = $this->query->getList(5);
        $this->assertEquals(count($pageFive), 2);
    }

    private function createThirtyProducts()
    {
        for ($i=0; $i<30; $i++) {
            $product = $this->createProduct();
            static::$em->persist($product);
        }
        static::$em->flush();
    }

    protected function tearDown()
    {
        $this->clearProductsTable();
    }
}
