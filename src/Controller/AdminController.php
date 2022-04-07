<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Proposal;
use App\Form\ProposalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/newProposal", name="newProposal")
     */
    public function newProposal(Request $request): Response
    {
        $proposal = new Proposal();

        $form = $this->createForm(ProposalType::class);
        $form->handleRequest($request);

        return $this->render('Admin/proposalForm.html.twig', [
            'form' => $form->createView()
        ]);
    }

}