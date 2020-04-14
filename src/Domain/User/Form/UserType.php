<?php

namespace App\Domain\User\Form;

use App\Domain\User\DataTransferObject\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class UserType
 * @package App\Domain\User\Form
 */
class UserType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                "label" => 'Email :'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe :'
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe :'
                ],
                'invalid_message' => 'La confirmation n\'est pas similaire au mot de passe.',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 8])
                ]
            ])
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo :'
            ])
        ;
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", User::class);
    }
}
