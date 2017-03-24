<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $page = $request->get('page', 1);
        $productList = $this->get('query.get-product-list')->getList($page);
        return $this->render('AppBundle::index/index.html.twig', [
            'list' => $productList,
        ]);
    }
}
