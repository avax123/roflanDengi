<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Payment;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PaymentCreateType extends AbstractType
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('amount', NumberType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field can not be empty.',
                    ]),
                ],
            ])
            ->add('description')
            ->add('category', ChoiceType::class, [
                'label' => 'Category',
                'choices' => $this->categoryRepository->findAll(),
                'choice_label' => function (Category $category, $key, $value) {
                    return $category->getName();
                },
                'choice_value' => function (Category $category = null) {
                    return $category ? $category->getId() : '';
                },
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payment::class,
        ]);
    }
}
