<?php

namespace App\Controller;

use App\Form\PaymentCreateType;
use App\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    /**
     * @Route("/payments/create", name="payments.create")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(PaymentCreateType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \App\Entity\Payment $payment */
            $payment = $form->getData();
            $payment->setUser($this->getUser());
            $payment->setCreatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();

            $em->persist($payment);
            $em->flush();

            return $this->redirectToRoute('payments.create');
        }

        return $this->render('payment/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/payments", name="payments.index")
     *
     * @param \App\Repository\PaymentRepository $paymentRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PaymentRepository $paymentRepository): Response
    {
        $payments = $paymentRepository->getLatest();

        return $this->render('payment/index.html.twig', [
            'payments' => $payments,
        ]);
    }
}
