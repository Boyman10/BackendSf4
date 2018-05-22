<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;

/**
 * Contract interface for ADMIN responder - ADR pattern
 * User: bill
 * Date: 13/05/2018
 * Time: 19:51
 */
interface AdminResponderInterface
{
    public function __invoke() : Response;
}