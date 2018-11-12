<?php

namespace App\Controller;

use App\Form\FirstUserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InstallerController extends AbstractController
{
    /**
     * @var \Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface
     */
    protected $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/installer", name="installer")
     *
     * @param \App\Repository\UserRepository $repository
     * @param Request                        $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, UserRepository $repository): Response
    {
        if ($this->isGranted('ROLE_USER') || $repository->getUsersCount() > 0) {
            return new RedirectResponse($this->generateUrl('dashboard'));
        }

        $form = $this->createForm(FirstUserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \App\Entity\User $user */
            $user = $form->getData();

            $user->setPassword(
                $this->passwordEncoder->encodePassword($user, $user->getPassword())
            );

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);

            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('installer/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
