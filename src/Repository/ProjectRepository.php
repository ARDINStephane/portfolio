<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\ProjectSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    /**
     * @param ProjectSearch $search
     * @return array|null
     */
    public function searchProject(ProjectSearch $search): ?array
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.title like :title')
            ->setParameter('title', '%' . $search . '%')
            ->orWhere('p.technologies like :technologies')
            ->setParameter('technologies', '%' . $search . '%')
            ->orderBy('p.updatedAt', 'DESC');

        $query = $qb->getQuery();

        return $query->execute();
    }
}
