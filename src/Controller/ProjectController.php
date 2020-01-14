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
    const PROJECT_LIST = "projectList";
    const EDIT = "edit";
    const NEW = "new";

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
     * @Route("/admin/project/new", name="project_new")
     * @Route("/admin/project/edit/{id}", name="project_edit")
     * @param Project|null $project
     * @param Request $request
     * @return Response
     */
    public function new(?Project $project, Request $request): Response
    {
        if(empty($project)) {
            $project = new Project();
            $action = self::NEW;
        } else {
            $action = self::EDIT;
        }

        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();
            $this->addFlash('success', $this->translator->trans('flash.' . $action . '.success'));

            return $this->redirectToRoute('project_list');
        }

        return $this->render('project/project_new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/project/list", name="project_list")
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
     * @Route("/project/show/{id}", name="project_show")
     * @param Project $project
     * @return Response
     */
    public function show(Project $project):Response
    {
        return $this->render('project/project_show.html.twig', [
            'project' => $project
        ]);
    }

    /**
     * @Route("/admin/project/delete/{id}", name="project_delete")
     * @param Project $project
     * @return Response
     */
    public function delete(Project $project):Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->remove($project);
        $entityManager->flush();

        return $this->redirectToRoute('project_list');
    }
}
