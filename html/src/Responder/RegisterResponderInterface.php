<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;

/**
 * Created by Boy - interface for our registration responder - member and client.
 * User: bob
 * Date: 15/05/18
 * Time: 16:26
 */
interface RegisterResponderInterface
{
    public function __invoke(array $data = null) : Response;
}