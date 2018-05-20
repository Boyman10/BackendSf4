<?php

namespace App\Action;

use App\Domain\Repository\PersonRepository;
use App\Responder\ProfileResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
     * @param Request $request
     * @param ProfileResponderInterface $responder
     * @param PersonRepository $personRepository
     * @param TokenStorageInterface $tokenStorage
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function __invoke(Request $request, ProfileResponderInterface $responder,
                             PersonRepository $personRepository,
                             TokenStorageInterface $tokenStorage): Response
    {
        $user = null;

        if (isset($tokenStorage)) {
            $user = $tokenStorage->getToken()->getUser();
        }

        $person = null;

        if ($user) {
            $person = $personRepository->findOneByMember($user->getId());
        } else {
            throw new \Exception(
                'No person found for id ' . $user->getId()
            );
        }
        return $responder($person);
    }
}