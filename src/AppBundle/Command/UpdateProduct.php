<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Session\Session;

class UpdateProduct implements CommandInterface
{
    private $em;

    private $session;

    private $product;

    public function __construct(EntityManager $em, Session $session)
    {
        $this->em = $em;
        $this->session = $session;
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
        $this->session->getFlashBag()->add('success', 'Produkt został edytowany');
    }
}