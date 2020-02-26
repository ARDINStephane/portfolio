<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestsController
 * @package App\Application\Common\Controller
 */
class TestController extends AbstractController
{
    /**
     * @var string
     */
    protected $yes = 'yes ça marche';
    /**
     * @var string
     */
    protected $cool = "Cool on va bien s'amuser";

    /**
     * @Route("/test", name="test.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('test/test.html.twig',[
            'res' =>$this->yes,
            'cool' => $this->cool
        ]);
    }
}