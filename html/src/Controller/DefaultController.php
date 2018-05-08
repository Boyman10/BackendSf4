<?php

namespace App\Controller;

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
     * @Route("/")
     * @param \Twig_Environment $twig
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(\Twig_Environment $twig) {

        $this->twig = $twig;

        $content = $this->twig->render("index.html.twig");

        return new Response($content);

    }

    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @Route("/profile")
     */
    public function profile()
    {
        return new Response('<html><body>User page!</body></html>');
    }
}