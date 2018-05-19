<?php

namespace App\Action;

use App\Domain\Entity\Client;
use App\Domain\Form\NewClientForm;
use App\Responder\RegisterResponderInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class handling the new client form
 * User: bob
 * Date: 01/05/18
 * Time: 17:51
 */
class RegisterClient
{
    /**
     * New Route to let the user fill in details about a client
     * @Route("/newclient", name="client_registration")
     * @Method({"GET", "POST"})
     * @param RegisterResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param ManagerRegistry $doctrine
     * @param LoggerInterface $logger
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response $twig
     */
    public function __invoke(Request $request, LoggerInterface $logger,
                             RegisterResponderInterface $responder,
                             FormFactoryInterface $formFactory, ManagerRegistry $doctrine) : Response
    {

        // 1) build the form
        $client = new Client();

        $form = $formFactory->create(NewClientForm::class, $client);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        // Handle the form submission
        if ($form->isSubmitted() && $form->isValid()) {

            $logger->info("Form is valid, we persist data to DB");

            // 4) save the User and addresses !
            $entityManager = $doctrine->getManager();

            $entityManager->persist($client);
            $entityManager->flush();

            // Return to view with message
            return $responder(['message' => "Good on you, the client is added ! Now check the details -- @TODO NEXT"]);
        }

        $data = ['form' => $form->createView()];
        // Return the new response from responder :

        return $responder($data);
    }
}