<?php

namespace App\Domain\User\Responder;

use App\Application\Entity\Post;
use App\Infrastructure\Representation\RepresentationInterface;
use Symfony\Component\Form\FormView;

/**
 * Class RegistrationResponder
 * @package App\Domain\User\Responder
 */
class RegistrationResponder
{
    /**
     * @var FormView
     */
    private FormView $form;

    /**
     * RegistrationResponder constructor.
     * @param FormView $form
     */
    public function __construct(FormView $form)
    {
        $this->form = $form;
    }

    /**
     * @return FormView
     */
    public function getForm(): FormView
    {
        return $this->form;
    }
}
