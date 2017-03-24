<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;

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
     * @Route("/admin/products/{page}", requirements={"page" = "\d+"}, defaults={"page" = "1"}, name="admin_product_list")
     */
    public function productsAction(Request $request)
    {
        $page = $request->get('page', 1);
        $productList = $this->get('query.get-product-list')->getList($page);
        return $this->render('AppBundle::admin/product_list.html.twig', [
            'list' => $productList,
        ]);
    }

    /**
     * @Route("/admin/new-product", name="admin_add_product")
     */
    public function addProduct(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command.add-product')
                ->setProduct($product)
                ->run();

            return $this->redirectToRoute('admin_edit_product', ['id' => 1]);
        }
        return $this->render('AppBundle::admin/product.html.twig', [
            'add' => true,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/product/{id}", requirements={"id" = "\d+"}, name="admin_edit_product")
     */
    public function editProduct(Request $request)
    {
        $productId = $request->get('id');
        $product = $this->get('query.find-product-by-id')->find($productId);
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('command.update-product')
                ->setProduct($product)
                ->run();
        }
        return $this->render('AppBundle::admin/product.html.twig', [
            'add' => false,
            'form' => $form->createView(),
        ]);
    }
}
