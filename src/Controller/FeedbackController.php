<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Proposal;
use App\Entity\ProposalFilled;
use App\Form\FillProposalType;
use App\Repository\ProposalRepository;
use App\Repository\FilledProposalsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/dashboard/myProposals/{id}", methods="GET|POST", name="feedbackActions")
     */
    public function feedbackActions(EntityManagerInterface $entityManager, int $id)
    {
        $userFilledProposal = $this->getDoctrine()->getRepository(ProposalFilled::class)->find(array('id' => $id));

        return $this->render('User/myFilledProposals.html.twig', []);
    }

}