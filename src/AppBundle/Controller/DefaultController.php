<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
<<<<<<< HEAD

=======
>>>>>>> a7789a83de335bbfdfc44ed66199769cf451b3f9
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
<<<<<<< HEAD

   /**
     * @Route("/scoreboard/input", name="scoreboard")
     *
     */
   public function scoreboardInputAction(Request $request)
   {
	return $this->render('scoreboard/input.html.twig', [
	    'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
	]);
   }
}
   
=======
    /**
     * @Route("/scoreboard/view", name="scoreboard")
     */
    public function scoreboardViewAction(Request $request){
	// replace this example code with whatever you need
        return $this->render('scoreboard/view.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
>>>>>>> a7789a83de335bbfdfc44ed66199769cf451b3f9
