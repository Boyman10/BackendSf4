<?php

namespace App\Action;

use App\Responder\DefaultResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Admin Action with one route for the admin interface
 * User: bill
 * Date: 13/05/2018
 * Time: 20:14
 * @Route("/admin",name="admin")
 */
final class Admin
{
    /**
     * Method being called by default
     * @param DefaultResponderInterface $responder
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request, DefaultResponderInterface $responder) : Response
    {
        return $responder("My admin message...");
    }
}