<?php

namespace App\Controller;

/**
 * Created by Boy.
 */
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{

    public function __invoke() {

        return new Response("Bill is not here");

    }

    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }

    /**
     * @Route("/profile")
     */
    public function profile()
    {
        return new Response('<html><body>User page!</body></html>');
    }
}