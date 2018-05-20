<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;

/**
 * Contract interface for profile responder - ADR pattern
 * User: bill
 */
interface ProfileResponderInterface
{
    public function __invoke($data) : Response;
}