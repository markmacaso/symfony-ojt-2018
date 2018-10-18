<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Player;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $obj = $builder->getData();

        $builder
            ->add(
                'id',
                HiddenType::class
            )->add(
                'firstName',
                TextType::class,
                [
                    'required' => true,
                    'label' => 'First Name',
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )->add(
                'lastName',
                TextType::class,
                [
                    'required' => true,
                    'label' => 'Last Name',
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => Player::class,
            'validation_groups' => [],
        ]);
    }
}
