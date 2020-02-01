<?php

namespace App\Controller;


use App\Entity\Project;
use App\Entity\ProjectSearch;
use App\Form\ProjectSearchType;
use App\Provider\ProjectProvider;
use App\Repository\ProjectRepository;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
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
     * @var ProjectProvider
     */
    private $projectProvider;

    public function __construct(
        ProjectProvider $projectProvider
    ) {
        $this->projectProvider = $projectProvider;
    }

    /**
     * @Route("/project/search/", name="project_search")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function search(PaginatorInterface $paginator, Request $request): Response
    {
        $form = $this->handleForm($request);
        $search = $request->query->get('search');
//dd($request->attributes->get('_route'));
        if($form->isSubmitted()
            && $form->isValid()
            || !empty($request->query->get('search'))
        ) {
            $search = $form->getData();

            $projects = $paginator->paginate(
                $this->projectProvider->searchProject($search),
                $request->query->getInt('page', 1),
                3
            );

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