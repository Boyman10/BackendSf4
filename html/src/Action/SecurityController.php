<?php

namespace App\Action;

use App\Responder\LoginResponder;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Controller for authentication system
 * Date: 29/04/2018
 * Time: 16:38
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @param LoginResponder $responder
     * @param LoggerInterface $logger
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Method({"GET", "POST"})
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils,
                          LoginResponder $responder, LoggerInterface $logger): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        // render the form
        try {
            $data = array(
                'last_username' => $lastUsername,
                'error' => $error,
            );
        } catch (\Exception $e) {
            $logger->info("Empty last username and error");
        }

        // Return the new response from responder :
        return $responder($data);

    }
}