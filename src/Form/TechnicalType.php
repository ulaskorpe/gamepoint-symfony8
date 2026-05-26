<?php

namespace App\Form;

use App\Entity\Technical;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TechnicalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'tech.form.title',
                'required' => true,
                'attr' => ['maxlength' => 255],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'tech.form.description',
                'required' => false,
                'attr' => ['rows' => 5],
            ])
            ->add('code', TextareaType::class, [
                'label' => 'tech.form.code',
                'required' => false,
                'attr' => ['rows' => 8, 'class' => 'font-monospace small'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => $options['submit_label'],
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Technical::class,
            'translation_domain' => 'project',
            'submit_label' => 'tech.form.submit',
        ]);
        $resolver->setAllowedTypes('submit_label', 'string');
    }
}
