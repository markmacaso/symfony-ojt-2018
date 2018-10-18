<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Game;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $obj = $builder->getData();

        $builder
            ->add(
                'id',
                HiddenType::class
            )->add(
                'homeTeam',
                HiddenType::class,
                [
                    'attr' => ['class' => 'form-control'],
                ]
            )->add(
                'visitorTeam',
                HiddenType::class,
                [
                    'attr' => ['class' => 'form-control'],
                ]
            )->add(
                'homeTeamText',
                TextType::class,
                [
                    'mapped' => false,
                    'required' => true,
                    'label' => 'Home Team',
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )->add(
                'visitorTeamText',
                TextType::class,
                [
                    'mapped' => false,
                    'required' => true,
                    'label' => 'Visitor Team',
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => Game::class,
            'validation_groups' => [],
        ]);
    }
}
