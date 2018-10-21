<?php

namespace App\Security\Csrf;

interface CsrfTokenIdManageInterface
{
    /**
     * @return string
     */
    public function getTokenId(): string;
}
