<?php

namespace AppBundle\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\TeamPlayer;

class TeamPlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $obj = $builder->getData();

        $builder
            ->add(
                'id',
                HiddenType::class
            )->add(
                'number',
                NumberType::class,
                [
                    'required' => true,
                    'label' => 'Number',
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )->add(
                'player',
                ChoiceType::class,
                [
                    'label'       => 'Player',
                    'choices'     => array_flip($options['players']),
                    'multiple'    => false,
                    'attr'        => [
                        'class' => 'student-enrollment-academic-year',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => TeamPlayer::class,
            'validation_groups' => [],
            'players'           => [],
        ]);
    }
}
