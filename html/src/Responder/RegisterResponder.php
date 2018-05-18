<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;

/**
 * Created by me - Responder for registration view.
 * User: bob
 * Date: 15/05/18
 * Time: 16:28
 */
final class RegisterResponder implements RegisterResponderInterface
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Here we actually render the page using Twig Templating
     * @param FormView $data
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function __invoke(FormView $data) : Response
    {

        $content = $this->twig->render("registration/register.html.twig", $data);

        return new Response($content);
    }
}