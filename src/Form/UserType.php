<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\ORM\Query\Expr\Select;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('first_name')
            ->add('surname')
            ->add('phone_number')
            ->add('adress')
            ->add('zipcode')
            ->add('city')
            ->add('country')
            ->add('roles',
                ChoiceType::class,
                array(
                    'mapped' => 'true',
                    'expanded' => 'true',
                    'multiple' => 'true',
                    'choices' => array(
                        'Gebruiker' => 'ROLE_USER',
                        'Administrator' => 'ROLE_ADMIN'
                    )
                ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
