<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactType extends AbstractType
{
    const QUESTION = 'question';
    const NOTE = 'note';
    const OTHER = 'other';
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
            ->add('object', ChoiceType::class, [
                'label' => $this->translator->trans('contact.form.object.object'),
                'choices' => [
                    $this->translator->trans('contact.form.object.question') => self::QUESTION,
                    $this->translator->trans('contact.form.object.note') => self::NOTE,
                    $this->translator->trans('contact.form.object.other') => self::OTHER
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => $this->translator->trans('contact.form.firstname'),
            ])
            ->add('lastname', TextType::class, [
                'label' => $this->translator->trans('contact.form.lastname'),
            ])
            ->add('phone', TextType::class, [
                'label' => $this->translator->trans('contact.form.phone')
            ])
            ->add('email', EmailType::class, [
                'label' => $this->translator->trans('contact.form.email'),
            ])
            ->add('message', TextareaType::class, [
                'label' => $this->translator->trans('contact.form.message'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'translation_domain' => 'forms'
        ]);
    }
}
