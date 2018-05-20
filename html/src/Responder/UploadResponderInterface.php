<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;

/**
 * Contract interface for default responder - ADR pattern
 * User: bill
 * Date: 13/05/2018
 * Time: 19:51
 */
interface UploadResponderInterface
{
    public function __invoke() : Response;
}