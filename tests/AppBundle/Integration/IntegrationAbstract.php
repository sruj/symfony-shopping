<?php
namespace Tests\AppBundle\Integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Entity\Product;

class IntegrationAbstract extends KernelTestCase
{
    protected static $em;

    protected $dummyProductName = 'well-known-name';

    public static function setUpBeforeClass()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        static::$kernel = $kernel;

        static::$em = $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    public static function tearDownAfterClass()
    {
        static::$em->close();
    }

    protected function clearProductsTable()
    {
        $products = static::$em->getRepository(Product::class)
            ->findAll();

        if (count($products) == 0) {
            return;
        }
        foreach ($products as $product) {
            static::$em->remove($product);
        }
        static::$em->flush();
    }

    /**
     * @return Product
     */
    protected function createProduct()
    {
        $product = new Product();
        $product->name = $this->dummyProductName;
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
    protected function productExistsOnDb(Product $whichProduct)
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
    protected function findProduct(Product $product)
    {
        return static::$em->getRepository(Product::class)->findOneBy([
            'id' => $product->id,
        ]);
    }
}