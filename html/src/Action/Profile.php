<?php

namespace App\Action;
use App\Responder\DefaultResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Profile page to retrieve current user profile
 * User: bill
 * Date: 13/05/2018
 * Time: 20:30
 * @Route("/profile",name="profile")
 */
class Profile
{
    /**
     * Default method being called
     * @param DefaultResponderInterface $responder
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request, DefaultResponderInterface $responder) : Response
    {
        return $responder("See myself clear ?");
    }
}