<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Team;
use AppBundle\Form\TeamPlayerType;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $obj = $builder->getData();

        $builder
            ->add(
                'id',
                HiddenType::class
            )->add(
                'name',
                TextType::class,
                [
                    'required' => true,
                    'label' => 'Name',
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )->add('teamPlayers', CollectionType::class, [
                'label'         => 'Players',
                'entry_type'    => TeamPlayerType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype'     => true,
                'entry_options' => [
                    'players'   => $options['players'],
                ],

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => Team::class,
            'validation_groups' => [],
            'players' => [],
        ]);
    }
}
