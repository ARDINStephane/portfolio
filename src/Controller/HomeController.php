<?php

namespace App\Controller;

use App\Provider\ProjectProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var ProjectProvider
     */
    private $projectProvider;

    public function __construct(
        ProjectProvider $projectProvider
    ) {
        $this->projectProvider = $projectProvider;
    }

    /**
     * @Route("/", name="home")
     */
    public function index():Response
    {
        return $this->render('home/home.html.twig');
    }
}
