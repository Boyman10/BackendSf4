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
final class Home
{
    /**
     * @Route("/",name="welcome")
     * @param DefaultResponderInterface $responder
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request, DefaultResponder $responder) : Response
    {
        return $responder(null);
    }

}