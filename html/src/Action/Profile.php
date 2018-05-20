<?php

namespace App\Action;

use App\Domain\Repository\PersonRepository;
use App\Responder\ProfileResponderInterface;
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
     * @param ProfileResponderInterface $responder
     * @param Request $request
     * @param PersonRepository $personRepository
     * @return Response
     */
    public function __invoke(Request $request, ProfileResponderInterface $responder,
                             PersonRepository $personRepository): Response
    {

        $person = $personRepository->find();

        if (!$person) {
            throw $this->createNotFoundException(
                'No person found for id '.$id
            );
        }
        return $responder();
    }
}