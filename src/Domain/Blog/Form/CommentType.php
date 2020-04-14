<?php

namespace App\Domain\Blog\Form;

use App\Domain\Blog\DataTransferObject\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Class CommentType
 * @package App\Domain\Blog\Form
 */
class CommentType extends AbstractType
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private AuthorizationCheckerInterface $authorizationChecker;

    /**
     * CommentType constructor.
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("content", TextareaType::class, [
                "label" => "Votre message :"
            ])
        ;

        if (!$this->authorizationChecker->isGranted("ROLE_USER")) {
            $builder->add("author", TextType::class, [
                "label" => "Pseudo :"
            ]);
        }
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault("data_class", Comment::class);
    }
}