<?php


namespace App\Provider;


use App\Entity\ProjectSearch;
use App\Repository\ProjectRepository;

class ProjectProvider
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(
        ProjectRepository $projectRepository
    ) {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @return array|null
     */
    public function provideAll(): ?array
    {
        $projectList = $this->projectRepository->findAll();
        foreach ($projectList as $project) {
            $project->setSkills($project->getSkills());
        }
        return $projectList;
    }

    /**
     * @param ProjectSearch $search
     * @return array|null
     */
    public function searchProject(ProjectSearch $search): ?array
    {
        return $this->projectRepository->searchProject($search);
    }
}