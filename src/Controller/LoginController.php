<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     *
     * @param \Symfony\Component\Security\Http\Authentication\AuthenticationUtils $authenticationUtils
     * @param UserRepository                                                      $repository
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils, UserRepository $repository)
    {
        if (0 === $repository->getUsersCount()) {
            return new RedirectResponse($this->generateUrl('installer'));
        }

        if ($this->isGranted('ROLE_USER')) {
            return new RedirectResponse($this->generateUrl('dashboard'));
        }

        $form = $this->createForm(LoginType::class);

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        if (null !== $error) {
            $form->setData([
                '_username' => $lastUsername,
            ]);
        }

        return $this->render('login.html.twig', [
            'error' => $error,
            'form' => $form->createView(),
        ]);
    }
}
