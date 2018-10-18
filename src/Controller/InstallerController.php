<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstallerController extends AbstractController
{
    /**
     * @Route("/installer", name="installer")
     *
     * @param \App\Repository\UserRepository $repository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(UserRepository $repository): Response
    {
        if ($this->isGranted('ROLE_USER') || $repository->getUsersCount() > 0) {
            return new RedirectResponse($this->generateUrl('dashboard'));
        }

        return $this->render('installer.html.twig');
    }
}
