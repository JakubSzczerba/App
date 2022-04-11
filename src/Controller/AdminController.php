<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Proposal;
use App\Form\ProposalType;
use App\Repository\ProposalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/newProposal", name="newProposal")
     */
    public function newProposal(Request $request, EntityManagerInterface $entityManager): Response
    {
        $proposal = new Proposal();

        $form = $this->createForm(ProposalType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form->get('name')->getData();
            $type = $form->get('type')->getData();
            $activity = $form->get('activity')->getData();
            $datetime = $form->get('datetime')->getData();
            $cover = $form->get('cover')->getData();
            $description = $form->get('description')->getData();
            $value = $form->get('value')->getData();
            $user = $this->getUser();

            $proposal->setName($name);
            $proposal->setType($type);
            $proposal->setActivity($activity);
            $proposal->setDatetime($datetime);
            $proposal->setCover($cover);
            $proposal->setDescription($description);
            $proposal->setValue($value);
            $proposal->setUser($user);

            $entityManager->persist($proposal);
            $entityManager->flush();

            $this->addFlash('success', 'Utworzono wniosek');

            return $this->redirectToRoute('panel');
        }

        return $this->render('Admin/proposalForm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/panel", methods="GET|POST", name="list")
     */
    public function showProposals(ProposalRepository $proposalRepository)
    {
        $id = $this->getUser()->getId();

        $showProposals = $proposalRepository->showProposals($id);

        return $this->render('Admin/panel.html.twig', [
            'proposals' => $showProposals,
        ]);
    }

    /**
     * @Route("/panel/off/{id}", methods="GET|POST", name="offStatus")
     */
    public function offStatus(EntityManagerInterface $entityManager, int $id)
    {
        $proposal = $this->getDoctrine()->getRepository(Proposal::class)->find(array('id' => $id));

        $proposal->setActivity(false);
        $entityManager->flush();

        return $this->redirectToRoute('panel');
    }

    /**
     * @Route("/panel/on/{id}", methods="GET|POST", name="onStatus")
     */
    public function onStatus(EntityManagerInterface $entityManager, int $id)
    {
        $proposal = $this->getDoctrine()->getRepository(Proposal::class)->find(array('id' => $id));

        $proposal->setActivity(true);
        $entityManager->flush();

        return $this->redirectToRoute('panel');
    }

    /**
     * @Route("/panel/remove/{id}", methods="GET|POST", name="removeProposal")
     */
    public function removeProposal(EntityManagerInterface $entityManager, int $id)
    {
        $proposal = $this->getDoctrine()->getRepository(Proposal::class)->find(array('id' => $id));

        if ($id)
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($proposal);
            $entityManager->flush();

            return $this->redirectToRoute('panel');
        }
        else {
            return $this->render('Admin/panel.html.twig');
        }
    }

    /**
     * @Route("/panel/edit/{id}", methods="GET|POST", name="editProposal")
     */
    public function editProposals(EntityManagerInterface $entityManager, Request $request, int $id)
    {
        $proposal = $this->getDoctrine()->getRepository(Proposal::class)->find(array('id' => $id));

        $form = $this->createForm(ProposalType::class, $proposal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('panel');
        }

        return $this->render('Admin/proposalForm.html.twig', [
            'form' => $form->createView()
        ]);

    }
}