<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @UniqueEntity("title")
 * @Vich\Uploadable
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $introduction;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $github;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $webSite;

    /**
     * @Vich\UploadableField(mapping="project_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $technologies;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $skills;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGithub(): ?string
    {
        return $this->github;
    }

    public function setGithub(?string $github): self
    {
        $this->github = $github;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;
        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getTechnologies(): ?string
    {
        $technologies = json_decode($this->technologies, true);

        if(empty($technologies)){
            return null;
        }
        return implode(', ',$technologies) ?? null;
    }

    public function setTechnologies(string $technologies): self
    {
        $technologies = explode(", ", $technologies);
        $this->technologies = json_encode(array_unique($technologies));

        return $this;
    }

    /**
     * @return string
     */
    public function getWebSite(): ?string
    {
        return $this->webSite;
    }

    /**
     * @param string $webSite
     * @return Project
     */
    public function setWebSite($webSite): self
    {
        $this->webSite = $webSite;
        return $this;
    }

    /**
     * @param bool $toArray
     * @return mixed|string
     */
    public function getSkills(bool $toArray = false): ?string
    {
        $skills = json_decode($this->skills, true);
        if($toArray) {
            return $skills;
        }
        if(empty($skills)){
            return null;
        }

        return implode(', ',$skills) ?? null;
    }

    /**
     * @param mixed $skills
     * @return Project
     */
    public function setSkills(string $skills):self
    {
        $skills = explode(", ", $skills);
        $this->skillsToArray = $skills;
        $this->skills = json_encode(array_unique($skills));

        return $this;
    }

    /**
     * @return array
     */
    protected function getSkillsToArray(): array
    {
        return $this->getSkills(true);
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
    }
}
