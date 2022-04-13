<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\ProposalFilled;
use App\Form\EditFilledProposalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/dashboard/myProposals/{id}", methods="GET|POST", name="viewProposal")
     */
    public function viewProposal(int $id)
    {
        $viewProposal = $this->getDoctrine()->getRepository(ProposalFilled::class)->find(array('id' => $id));
        $new = 'Nowy';
        $accepted = 'Zaakceptowany';
        $refused = 'Odrzucony';
        $needChange = 'Wymagana zmiana';
        $corrected = 'Poprawiony';

        return $this->render('User/viewFilledProposal.html.twig', [
            'proposal' => $viewProposal,
        ]);
    }

    /**
     * @Route("/dashboard/myProposals/edit/{id}", methods="GET|POST", name="editFilledProposal")
     */
    public function editFilledProposal(Request $request, EntityManagerInterface $entityManager, int $id)
    {
        $proposal = $this->getDoctrine()->getRepository(ProposalFilled::class)->find(array('id' => $id));
        $new = 'Nowy';
        $decision = '';
        $needChange = 'Wymagana zmiana';
        $corrected = 'Wymaga weryfiakcji';
        $information = '';

        $form = $this->createForm(EditFilledProposalType::class, $proposal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($proposal->getDecision() == $needChange) {
                $decision = $corrected;
            } elseif ($proposal->getDecision() == $new) {
                 $decision = $new;
                }
            $proposal->setDecision($decision);
            $proposal->setInformation($information);

            $entityManager->persist($proposal);
            $entityManager->flush();

            return $this->redirectToRoute('myProposals');
        }

        return $this->render('User/editFilledProposalForm.html.twig', [
            'form' => $form->createView(),
            'proposal' => $proposal,
        ]);
    }

}