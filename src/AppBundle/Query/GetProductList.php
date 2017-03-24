<?php

namespace AppBundle\Query;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Product;
use AppBundle\Exception\ProductNotFoundException;
use Knp\Component\Pager\Paginator;

class GetProductList extends AbstractQuery
{
    private $em;

    private $paginator;

    public function __construct(EntityManager $em, Paginator $paginator)
    {
        $this->em = $em;
        $this->paginator = $paginator;
    }

    public function getList(int $currentPage)
    {
        $repository = $this->em->getRepository(Product::class);
        $query = $this->em->createQuery("SELECT p FROM AppBundle:Product p");

        $pagination = $this->paginator->paginate($query, $currentPage, $this->itemsPerPage);
        return $pagination;
    }
}