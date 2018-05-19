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
final class RegisterClient
{

    /**
     * @var $responder
     */
    private $responder;
    /**
     * @var $formFactory
     */
    private $formFactory;
    /**
     * @var $doctrine
     */
    private $doctrine;
    /**
     * @var $logger
     */
    private $logger;
    /**
     * @var $request
     */
    private $request;
    /**
     * RegisterClient constructor.
     * @param RegisterResponderInterface $responder
     * @param FormFactoryInterface $formFactory
     * @param ManagerRegistry $doctrine
     * @param LoggerInterface $logger
     * @param Request $request
     */
    public function __construct(RegisterResponderInterface $responder,
                                Request $request, LoggerInterface $logger,
                                FormFactoryInterface $formFactory,
                                ManagerRegistry $doctrine)
    {
        $this->responder = $responder;
        $this->logger = $logger;
        $this->doctrine = $doctrine;
        $this->formFactory = $formFactory;
        $this->request = $request;
    }

    /**
     * New Route to let the user fill in details about a client
     * @Route("/newclient", name="client_registration")
     * @Method({"GET", "POST"})
     * @return \Symfony\Component\HttpFoundation\Response $twig
     */
    public function __invoke() : Response
    {

        // 1) build the form
        $client = new Client();

        $form = $this->formFactory->create(NewClientForm::class, $client);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($this->request);

        // Handle the form submission
        if ($form->isSubmitted() && $form->isValid()) {

            $this->logger->info("Form is valid, we persist data to DB");

            // 4) save the User and addresses !
            $entityManager = $this->doctrine->getManager();

            $entityManager->persist($client);
            $entityManager->flush();

            // Return to view with message
            return $this->responder(['message' => "Good on you, the client is added ! Now check the details -- @TODO NEXT"]);
        }

        $data = ['form' => $form->createView()];
        // Return the new response from responder :

        return $this->responder($data);
    }
}