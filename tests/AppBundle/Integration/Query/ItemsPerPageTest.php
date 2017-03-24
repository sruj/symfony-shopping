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

    public function data_getTestData()
    {
        return [
            [3, [1 => 3, 2 => 3, 10 => 3]],
            [7, [1 => 7, 2 => 7, 5 => 2]],
        ];
    }

    /**
     * @dataProvider data_getTestData
     * @param int $itemsPerPage
     * @param array $pageData
     */
    public function testItemsPerPage(int $itemsPerPage, array $pageData)
    {
        $this->query->itemsPerPage = $itemsPerPage;
        foreach ($pageData as $pageNo => $countNeeded)
        {
            $page = $this->query->getList($pageNo);
            $this->assertEquals(count($page), $countNeeded);
        }
    }

    private function createThirtyProducts()
    {
        for ($i=0; $i<30; $i++)
        {
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
