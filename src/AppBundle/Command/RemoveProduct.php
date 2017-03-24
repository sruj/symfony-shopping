<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Product;

class RemoveProduct implements CommandInterface
{
    private $em;

    private $product = null;

    public function __construct(EntityManager $em, Session $session)
    {
        $this->em = $em;
        $this->session = $session;
    }

    public function setProduct(Product $product) : RemoveProduct
    {
        $this->product = $product;
        return $this;
    }

    public function run()
    {
        if ($this->product === null)
        {
            throw new \InvalidArgumentException('Nie podano produktu');
        }
        $this->em->remove($this->product);
        $this->em->flush();

        $this->session->getFlashBag()->add('success', 'Produkt został usunięty');
    }
}