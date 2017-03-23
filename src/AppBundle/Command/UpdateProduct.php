<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Product;

class UpdateProduct implements CommandInterface
{
    private $em;

    private $product;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function setProduct(Product $product) : UpdateProduct
    {
        $this->product = $product;
        return $this;
    }

    public function run()
    {
        $this->em->persist($this->product);
        $this->em->flush();
    }
}