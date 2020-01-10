<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Provider\ProjectProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @var ProjectProvider
     */
    private $projectProvider;
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        ProjectProvider $projectProvider,
        TranslatorInterface $translator
    ) {
        $this->projectProvider = $projectProvider;
        $this->translator = $translator;
    }

    /**
     * Register new project in bdd
     * @Route("/project/new", name="project.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $project = new Project();

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();
            $this->addFlash('success', $this->translator->trans('flash.success'));

            return $this->redirectToRoute('project.list');
        }

        return $this->render('project/project_new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/project/list", name="project.list")
     * @return Response
     */
    public function list():Response
    {
        $list = $this->projectProvider->provideAll();
        return $this->render('project/project_list.html.twig', [
            'projectList' => $list
        ]);
    }

    /**
     * @Route("/project/show/{id}", name="project.show")
     * @return Response
     */
    public function show(Project $project):Response
    {
        return $this->render('project/project_show.html.twig', [
            'project' => $project
        ]);
    }
}
