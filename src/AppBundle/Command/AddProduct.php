<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Product;

class AddProduct implements CommandInterface
{
    private $em;

    private $session;

    private $mailer;

    private $twig;

    private $product = null;

    public function __construct(EntityManager $em, Session $session, \Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->em = $em;
        $this->session = $session;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function setProduct(Product $product) : AddProduct
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
        $this->em->persist($this->product);
        $this->em->flush();

        $this->session->getFlashBag()->add('success', 'Produkt został dodany');
        $this->notifyByEmail();
    }

    private function notifyByEmail()
    {
        $message = $this->createMessage();
        $this->mailer->send($message);
    }

    private function createMessage()
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Nowy produkt został dodany')
            ->setFrom('send@example.com')
            ->setTo('admin@example.com')
            ->setBody(
                $this->twig->render('AppBundle::emails/new-product.html.twig', [
                    'name' => $this->product->name
                ]), 'text/html'
            );
        return $message;
    }
}