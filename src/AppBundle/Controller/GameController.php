<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Game;
use AppBundle\Entity\GameEvent;
use AppBundle\Entity\Team;
use AppBundle\Form\GameType;

/**
 * @Route("/game")
 */
class GameController extends Controller
{
    /**
     * @Route("/list", name="game_list")
     *
     */
    public function listAction(Request $request)
    {
        $games = $this->getDoctrine()->getRepository(Game::class)
            ->findAll();

        return $this->render(
            '@App/Game/list.html.twig',
            [
                'title' => 'Game List',
                'games' => $games,
            ]
        );
    }

   
    /**
     * @Route("/create", name="game_create")
     */
    public function createAction(Request $request)
    {

        $form = $this->createForm(GameType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $data = $request->request->get('game');
            $team1 = new Team();
            $team1->setName($data['homeTeamText']);
            $team2 = new Team();
            $team2->setName($data['visitorTeamText']);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($team1);
            $entityManager->persist($team2);

            $game = new Game();
            $game->setHomeTeam($team1);
            $game->setVisitorTeam($team2);
            $game->setPeriod(1);
            $game->setTime('10:00:000');
            $game->setScores([
                $team1->getId() => 0,
                $team2->getId() => 0,
            ]);

            $entityManager->persist($game);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Game was successfully created'
            );

            return $this->redirectToRoute('game_controls', ['id' => $game->getId()]);
        }

        return $this->render(
            '@App/Game/create.html.twig',
            [
                'title' => 'Create Game',
                'form'  => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/edit", name="game_edit")
     */
    public function editAction(Request $request)
    {
        return $this->render('@App/Game/edit.html.twig');
    }

    /**
     * @Route("/controls/{id}", name="game_controls")
     * @param int $id
     */
    public function controlsAction(Request $request, $id)
    {
        $game = $this->getDoctrine()->getRepository(Game::class)
            ->find($id);
        $time = explode(':', $game->getTime());
        $timer = [
            'period' => $game->getPeriod(),
            'minutes' => $time[0],
            'seconds' => $time[1],
            'milliseconds' => $time[2],
        ];

        return $this->render(
            '@App/Game/controls.html.twig',
            [
                'title' => 'Game Controls',
                'game' => $game,
                'timer' => $timer,
            ]
        );
    }

    /**
     * @Route("/event/{id}", name="game_event")
     * @param int $id
     */
    public function eventAction(Request $request, $id)
    {
        $game = $this->getDoctrine()->getRepository(Game::class)
            ->find($id);
        $team_id = $request->request->get('team_id');
        $team = $this->getDoctrine()->getRepository(Team::class)
            ->find($team_id);
        $type = $request->request->get('type');
        $player = $request->request->get('player_id');
        $score = $request->request->get('score');
        $period = $request->request->get('period');
        $time = $request->request->get('time');
        $data = [];

        if ('score' == $type) {
            $points = $request->request->get('points');
            $data = [
                'points' => $points,
                'description' => $request->request->get('description'),
            ];
            $score += $points;

            $scores = $game->getScores();
            $scores[$team->getId()] = $score;
            $game->setScores($scores);
        }

        if (empty($player)) {
            $player = null;
        }

        $event = new GameEvent();
        $event->setGame($game);
        $event->setType($type);
        $event->setTeam($team);
        $event->setPlayer($player);
        $event->setPeriod($period);
        $event->setTime($time);
        $event->setScore($score);
        $event->setData($data);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($event);
        $entityManager->flush();

        return new JsonResponse([
            'type' => $type,
            'team_id' => $team_id,
            'player_id' => $player,
            'score' => $score,
            'period' => $period,
            'time' => $time,
            'data' => $data,
        ]);
    }

    /**
     * @Route("/time/{id}", name="game_time")
     * @param int $id
     */
    public function timeAction(Request $request, $id)
    {
        $game = $this->getDoctrine()->getRepository(Game::class)
            ->find($id);
        $period = $request->request->get('period');
        $time = $request->request->get('time');
        $action = $request->request->get('action');

        $game->setPeriod($period);
        $game->setTime($time);

        if ($action == 'stop') {
            $game->setLastStartAt(null);
        } elseif ($action == 'start') {
            $game->setLastStartAt(new \DateTime());
        }
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return new JsonResponse([
            'status' => 'ok',
        ]);
    }
}
