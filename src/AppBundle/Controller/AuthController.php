<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @Route("/login", name="auth_login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('AppBundle::auth/login.html.twig', [
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="auth_logout")
     */
    public function logoutAction(Request $request)
    {
        return new Response('logout');
    }
}
