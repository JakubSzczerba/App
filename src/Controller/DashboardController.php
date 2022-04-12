<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Proposal;
use App\Entity\ProposalFilled;
use App\Form\FillProposalType;
use App\Repository\ProposalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="show")
     */
    public function listActiveProposals(ProposalRepository $proposalRepository)
    {
        $showActiveProposals = $proposalRepository->showActiveProposals();

        return $this->render('User/dashboard.html.twig', [
            'proposals' => $showActiveProposals,
        ]);
    }

    /**
     * @Route("/fill/{id}", methods="GET|POST", name="fill")
     */
    public function fillProposal(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $proposal = $this->getDoctrine()->getRepository(Proposal::class)->find(array('id' => $id));
        $filledProposal = new ProposalFilled();

        $form = $this->createForm(FillProposalType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $value = $form->get('value')->getData();
            $user = $this->getUser();
            $decision = 'Nowy';
            $information = '';

            $filledProposal->setValue($value);
            $filledProposal->setUsers($user);
            $filledProposal->setProposal($proposal);
            $filledProposal->setDecision($decision);
            $filledProposal->setInformation($information);

            $entityManager->persist($filledProposal);
            $entityManager->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('User/fillProposalForm.html.twig', [
            'form' => $form->createView(),
            'proposal' => $proposal,
        ]);

    }

    /**
     * @Route("/dashboard/myProposals", methods="GET|POST", name="myProposals")
     */
    public function myProposals()
    {
    }

}