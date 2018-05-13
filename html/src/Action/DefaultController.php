<?php

namespace App\Action;

use App\Responder\DefaultResponder;
use App\Responder\DefaultResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Created by Boy.
 * @see http://symfony.com/doc/current/controller/service.html
 */
class DefaultController
{
    private $twig;

    /**
     * @Route("/",name="welcome")
     * @param DefaultResponderInterface $responder
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request, DefaultResponderInterface $responder) : Response
    {
        return $responder(null);
    }

    /**
     * @Route("/admin",name="admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @Route("/profile",name="profile")
     * @param \Twig_Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function profile(\Twig_Environment $twig)
    {

        $this->twig = $twig;

        $content = $this->twig->render("admin/profile.html.twig");

        return new Response($content);    }
}