<?php

namespace App\Action;

use App\Domain\Entity\Member;
use App\Domain\Form\RegisterForm;
use App\Domain\Repository\RoleRepository;
use App\Responder\RegisterResponder;
use App\Responder\RegisterResponderInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Registration Action
 * Date: 29/04/2018 - changed to action class now
 * Time: 17:16
 * @version 1.2
 * @see https://github.com/symfony/symfony/blob/master/src/Symfony/Bundle/FrameworkBundle/Controller/AbstractController.php
 */
class Registration
{
    /**
     * @Route("/register", name="user_registration")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param LoggerInterface $logger
     * @param RoleRepository $role
     * @param RegisterResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param ManagerRegistry $doctrine
     * @param RouterInterface $router
     * @param Session $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response $twig
     */
    public function __invoke(Request $request, UserPasswordEncoderInterface $passwordEncoder,
                             LoggerInterface $logger, RoleRepository $role,
                             RegisterResponder $responder,
                             FormFactoryInterface $formFactory, ManagerRegistry $doctrine,
                             RouterInterface $router,
                             Session $session) : Response
    {
        // 1) build the form
        $user = new Member($role);
        $form = $formFactory->create(RegisterForm::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        // Handle the form submission
        if ($form->isSubmitted() && $form->isValid()) {

            $logger->info("Form is valid, we persist data to DB");

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $doctrine->getManager();

            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $session->getFlashBag()->add(
                'notice',
                'Your changes were saved, you may now log in!'
            );

            return new RedirectResponse($router->generate('login',array()));
        }

        // Return the new response from responder :
        return $responder(array('form' => $form->createView()));

    }


}