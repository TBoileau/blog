<?php

namespace App\Domain\Blog\Presenter;

/**
 * Class UpdatePostPresenter
 * @package App\Domain\Blog\Presenter
 */
class UpdatePostPresenter extends AbstractEditPostPresenter implements UpdatePostPresenterInterface
{
    /**
     * @inheritDoc
     */
    protected function getView(): string
    {
        return "blog/create.html.twig";
    }
}