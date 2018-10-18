<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/scoreboard")
 */
class ScoreboardController extends Controller
{
    /**
     * @Route("/input", name="scoreboard_input")
     *
     */
    public function scoreboardInputAction(Request $request)
    {
        $teams = [
            [
                "id" => "home",
                "name" => "Home",
                "score" => 0,
            ],
            [
                "id" => "guest",
                "name" => "Guest",
                "score" => 0,
            ]
        ];
        $timer = [
            "minutes"      => "10",
            "seconds"      => "0",
            "milliseconds" => "0",
        ];
        return $this->render(
            '@App/Scoreboard/input.html.twig',
            [
                'title' => 'Scoreboard Input',
                'teams' => $teams,
                'timer' => $timer,
            ]
        );
    }

   
    /**
     * @Route("/scoreboard/view", name="scoreboard_view")
     */
    public function scoreboardViewAction(Request $request){
        return $this->render('@App/Scoreboard/view.html.twig', ['title' => 'Scoreboard View']);
    }

   /**
    * @Route("/scoreboard", name="scoreboard")
    */
    public function scoreboardIndexAction(Request $request){
	    return $this->render('@App/Scoreboard/index.html.twig',['title' => 'Scoreboard Home']);
    }

    public function scoreUpdateAction(Request $request) {
    }
}
