<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;

/**
 * Responder class returning data
 * User: bill
 * Date: 13/05/2018
 * Time: 19:41
 */
final class DefaultResponder implements DefaultResponderInterface
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke($data) : Response
    {
        $message = Array();
        $message['flash_message'] = $data;

        $content = $this->twig->render("index.html.twig", $message);

        return new Response($content);
    }
}