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
            if ($this->getUser()->getRoles() === ['ROLE_ADMIN'])
            {
                return $this->redirectToRoute('panel');
            }
            else {
            return $this->redirectToRoute('dashboard');
            }
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

    /**
     * @Route("/panel", name="panel")
     */
    public function panel()
    {
        return $this->render('Admin/panel.html.twig');
    }
}