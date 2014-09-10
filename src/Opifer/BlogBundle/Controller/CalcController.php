<?php

namespace Opifer\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalcController extends Controller
{
    /**
     * Calculates depending op math opperator given in path
     *
     * Example URL:
     * example.com/calculate/add/3/4
     *
     * @param string $path URL given via browser
     * @return \Symfony\Component\HttpFoundation\Response  the calculate view
     */
    public function calculateAction($path)
    {
        $path = explode("/", $path);
        $numbers = array_slice($path, 2);


        if($path[1] == "add")
            $answer = $this->get('opifer_calculator')->add($numbers);

        if($path[1] == "substract")
            $answer = $this->get('opifer_calculator')->add($numbers);

        if($path[1] == "multiply")
            $answer = $this->get('opifer_calculator')->multiply($numbers);

        if($path[1] == "divide")
            $answer = $this->get('opifer_calculator')->add($numbers);

        return $this->render('OpiferBlogBundle:Calc:calculate.html.twig', array(
            'answer' => $answer,
        ));
    }

}
