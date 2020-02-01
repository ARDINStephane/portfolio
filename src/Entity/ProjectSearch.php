<?php

namespace App\Entity;


class ProjectSearch
{
    /**
     * @var string | null
     */
    private $search;
    /**
     * @var string | null
     */
    private $technologies;

    /**
     * @return string|null
     */
    public function getTechnologies(): ?string
    {
        return $this->technologies;
    }

    /**
     * @param string|null $technologies
     * @return ProjectSearch
     */
    public function setTechnologies(?string $technologies): ProjectSearch
    {
        $this->technologies = $technologies;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @param mixed $search
     * @return ProjectSearch
     */
    public function setSearch($search)
    {
        $this->search = $search;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->search ?? '';
    }
}