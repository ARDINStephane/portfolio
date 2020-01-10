<?php


namespace App\Provider;


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
        return $this->projectRepository->findAll();
    }
}