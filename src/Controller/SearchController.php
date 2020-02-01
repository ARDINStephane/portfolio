<?php

namespace App\Controller;


use App\Entity\Project;
use App\Entity\ProjectSearch;
use App\Form\ProjectSearchType;
use App\Repository\ProjectRepository;
use Knp\Component\Pager\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SearchController
 * @package App\Application\Search\Controller
 */
class SearchController extends AbstractController
{
    /**
     * @var Paginator
     */
    private $paginator;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(
        ProjectRepository $projectRepository
    )
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @Route("/project/search/", name="project_search")
     * @return Response
     */
    public function search(Request $request): Response
    {
        $form = $this->handleForm($request);

        if($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData();
            $projects = $this->projectRepository->searchProject($search);

            return $this->render('project/project_list.html.twig', [
                'form' => $form->createView(),
                'projectList' => $projects
            ]);
        }

        return $this->render('includes/search_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return FormInterface
     */
    public function handleForm(Request $request)
    {
        $newSearch = new ProjectSearch();
        $form = $this->createForm(ProjectSearchType::class, $newSearch);
        $form->handleRequest($request);

        return $form;
    }
}