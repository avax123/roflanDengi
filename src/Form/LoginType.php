<?php

namespace App\Form;

use App\Security\Csrf\CsrfTokenIdManageInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    /**
     * @var \App\Security\Csrf\CsrfTokenIdManageInterface
     */
    protected $csrfTokenIdManage;

    public function __construct(CsrfTokenIdManageInterface $csrfTokenIdManage)
    {
        $this->csrfTokenIdManage = $csrfTokenIdManage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('_username', TextType::class)
            ->add('_password', PasswordType::class)
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id' => $this->csrfTokenIdManage->getTokenId(),
        ]);
    }
}
