<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\NewClientForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class handling the new client form
 * User: bob
 * Date: 01/05/18
 * Time: 17:51
 */
class RegisterClientController extends AbstractController
{
    /**
     * New Route to let the user fill in details about a client
     * @Route("/newclient", name="client_registration")
     * @Method({"GET", "POST"})
     */
    public function newClient() {

        // 1) build the form
        $client = new Client();
        $form = $this->createForm(NewClientForm::class, $client);


        return $this->render(
            'registration/newclient.html.twig',
            array('form' => $form->createView())
        );
    }
}