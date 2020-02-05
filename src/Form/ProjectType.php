<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProjectType extends AbstractType
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        TranslatorInterface $translator
    ) {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => $this->translator->trans('project.title'),
                'attr' => [
                    'placeholder' => $this->translator->trans('project.placeholder.title')
                ]
            ])
            ->add('technologies', TextType::class, [
                'label' => $this->translator->trans('project.technologies'),
                'attr' => [
                    'placeholder' => $this->translator->trans('project.placeholder.technologies')
                ]
            ])
            ->add('skills', TextType::class, [
                'label' => $this->translator->trans('project.skills'),
                'attr' => [
                    'placeholder' => $this->translator->trans('project.skills')
                ]
            ])
            ->add('introduction', TextType::class, [
                'label' => $this->translator->trans('project.introduction'),
                'attr' => [
                    'placeholder' => $this->translator->trans('project.placeholder.introduction')
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => $this->translator->trans('project.description'),
                'attr' => [
                    'placeholder' => $this->translator->trans('project.placeholder.description')
                ]
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => $this->translator->trans('project.image'),
                'attr' => [
                    'placeholder' => $this->translator->trans('project.placeholder.image')
                ]
            ])
            ->add('github', UrlType::class, [
                'required' => false,
                'label' => $this->translator->trans('project.github'),
                'attr' => [
                    'placeholder' => $this->translator->trans('project.placeholder.github')
                ]
            ])
            ->add('webSite', UrlType::class, [
                'required' => false,
                'label' => $this->translator->trans('project.webSite'),
                'attr' => [
                    'placeholder' => $this->translator->trans('project.webSite')
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
