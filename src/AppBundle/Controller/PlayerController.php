<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Player;
use AppBundle\Form\PlayerType;

/**
 * @Route("/player")
 */
class PlayerController extends Controller
{
    /**
     * @Route("/list", name="player_list")
     *
     */
    public function listAction(Request $request)
    {
        $players = $this->getDoctrine()->getRepository(Player::class)
            ->findBy([], ['lastName' => 'ASC']);

        return $this->render(
            '@App/Player/list.html.twig',
            [
                'title'   => 'Player List',
                'players' => $players,
            ]
        );
    }

   
    /**
     * @Route("/create", name="player_create")
     */
    public function createAction(Request $request)
    {

        $player = new Player();
        $form   = $this->createForm(PlayerType::class, $player);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($player);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Successfully added a new player'
            );

            return $this->redirectToRoute('player_list');
        }

        return $this->render(
            '@App/Player/create.html.twig',
            [
                'title' => 'Create Player',
                'form'  => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/edit", name="player_edit")
     */
    public function editAction(Request $request)
    {
        return $this->render('@App/Player/edit.html.twig');
    }

    /**
     * @Route("/delete/{id}", name="player_delete")
     * @param int $id
     */
    public function deleteAction(Request $request, $id)
    {
        $player = $this->getDoctrine()->getRepository(Player::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($player);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'Successfully removed player'
        );

        return $this->redirectToRoute('player_list');
    }
}
