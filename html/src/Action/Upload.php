<?php

namespace App\Action;

use App\Responder\UploadResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Created by Boy.
 * @see http://symfony.com/doc/current/controller/service.html
 */
final class Upload
{
    /**
     * @Route("/profile/upload",name="upload")
     * @param UploadResponderInterface $responder
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request, UploadResponderInterface $responder) : Response
    {
        return $responder();
    }

}