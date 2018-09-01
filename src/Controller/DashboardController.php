<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="dashboard")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return new Response(sprintf(
            '<html><body>Hello %s %s - you logged in.</body></html>',
            $this->getUser()->getName(), $this->getUser()->getLastname()
        ));
    }
}
