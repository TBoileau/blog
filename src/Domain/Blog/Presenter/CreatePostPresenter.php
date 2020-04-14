<?php

namespace App\Domain\Blog\Presenter;

/**
 * Class CreatePostPresenter
 * @package App\Domain\Blog\Presenter
 */
class CreatePostPresenter extends AbstractEditPostPresenter implements CreatePostPresenterInterface
{
    /**
     * @inheritDoc
     */
    protected function getView(): string
    {
        return "blog/create.html.twig";
    }
}