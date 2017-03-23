<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function dashboardAction(Request $request)
    {
        return $this->render('AppBundle::admin/dashboard.html.twig');
    }

    /**
     * @Route("/admin/products", name="admin_product_list")
     */
    public function productsAction(Request $request)
    {
        return $this->render('AppBundle::admin/product_list.html.twig');
    }
}
