<?php

namespace App\Security\Csrf;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LoginCsrfTokenId implements CsrfTokenIdManageInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface
     */
    protected $parameterBag;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->parameterBag = $parameterBag;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenId(): string
    {
        return $this->parameterBag->get('login_form.csrf_token_id');
    }
}
