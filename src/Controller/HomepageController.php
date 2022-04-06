<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function homepage()
    {
        if ($this->getUser())
        {
            return $this->redirectToRoute('dashboard');
        }

        else {
            return $this->render('Homepage/homepage.html.twig');
        }
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboard()
    {
        return $this->render('User/dashboard.html.twig');
    }
}