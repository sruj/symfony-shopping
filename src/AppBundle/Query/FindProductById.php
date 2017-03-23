<?php

namespace AppBundle\Query;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Product;
use AppBundle\Exception\ProductNotFoundException;

class FindProductById
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function find(int $id) : Product
    {
        $repository = $this->em->getRepository(Product::class);
        $product = $repository->findOneBy(['id' => $id]);
        if ($product === null) {
            throw new ProductNotFoundException('Produkt nie został znaleziony');
        }
        return $product;
    }
}