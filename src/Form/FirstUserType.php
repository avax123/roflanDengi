<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class FirstUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Firs name',
                'constraints' => [
                    new NotBlank(['message' => 'This field can not be empty.'])
                ],
            ])
            ->add('last_name', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'This field can not be empty.'])
                ],
            ])
            ->add('login', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'This field can not be empty.'])
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match',
                'first_options' => [
                    'label' => 'Password'
                ],
                'second_options' => [
                    'label' => 'Repeat password'
                ],
                'constraints' => [
                    new NotBlank(['message' => 'This field can not be empty.']),
                    new Length([
                        'min' => 8,
                        'max' => 32,
                        'minMessage' => 'The password must be at least {{ limit }} characters long',
                        'maxMessage' => 'Password must not exceed {{ limit }} characters'
                    ])
                ],
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
