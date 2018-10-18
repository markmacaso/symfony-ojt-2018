<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use AppBundle\Form\TeamType;

/**
 * @Route("/team")
 */
class TeamController extends Controller
{
    /**
     * @Route("/list", name="team_list")
     *
     */
    public function listAction(Request $request)
    {
        $teams = $this->getDoctrine()->getRepository(Team::class)
            ->findBy([], ['name' => 'ASC']);

        return $this->render(
            '@App/Team/list.html.twig',
            [
                'title' => 'Teams',
                'teams' => $teams,
            ]
        );
    }

   
    /**
     * @Route("/create", name="team_create")
     */
    public function createAction(Request $request)
    {
        $list = $this->getDoctrine()->getRepository(Player::class)
            ->findBy([], ['lastName' => 'ASC']);
        $players = [];

        foreach ($list as $player) {
            $players[$player->getId()] = $player->getLastName() . ', ' . $player->getFirstName();
        }

        $team = new Team();
        $form = $this->createForm(
            TeamType::class,
            $team,
            [
                'players' => $players,
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($team);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Successfully added a new team'
            );

            return $this->redirectToRoute('team_list');
        }

        return $this->render(
            '@App/Team/create.html.twig',
            [
                'title' => 'Create Team',
                'form'  => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/edit", name="team_edit")
     */
    public function editAction(Request $request)
    {
        return $this->render('@App/Team/edit.html.twig');
    }

    /**
     * @Route("/delete/{id}", name="team_delete")
     * @param int $id
     */
    public function deleteAction(Request $request, $id)
    {
        $team = $this->getDoctrine()->getRepository(Team::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($team);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'Successfully removed team'
        );

        return $this->redirectToRoute('team_list');
    }
}
