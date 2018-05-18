<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;

/**
 * Responder class returning data
 * User: bill
 * Date: 13/05/2018
 * Time: 19:41
 */
final class LoginResponder implements DefaultResponderInterface
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Here we actually render the page using Twig Templating
     * @param $data
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke($data) : Response
    {

        $content = $this->twig->render("security/login.html.twig", $data);

        return new Response($content);
    }
}