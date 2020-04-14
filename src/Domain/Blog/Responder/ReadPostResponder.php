<?php

namespace App\Domain\Blog\Responder;

use App\Application\Entity\Post;
use App\Infrastructure\Representation\RepresentationInterface;
use Symfony\Component\Form\FormView;

/**
 * Class ReadPostResponder
 * @package App\Domain\Blog\Responder
 */
class ReadPostResponder
{
    /**
     * @var Post
     */
    private Post $post;

    /**
     * @var RepresentationInterface
     */
    private RepresentationInterface $representation;

    /**
     * @var FormView
     */
    private FormView $form;

    /**
     * ReadPostResponder constructor.
     * @param Post $post
     * @param RepresentationInterface $representation
     * @param FormView $form
     */
    public function __construct(Post $post, RepresentationInterface $representation, FormView $form)
    {
        $this->post = $post;
        $this->representation = $representation;
        $this->form = $form;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * @return RepresentationInterface
     */
    public function getRepresentation(): RepresentationInterface
    {
        return $this->representation;
    }

    /**
     * @return FormView
     */
    public function getForm(): FormView
    {
        return $this->form;
    }
}
