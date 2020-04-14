<?php

namespace App\Domain\Blog\Controller;

use App\Application\Entity\Post;
use App\Domain\Blog\Handler\PostHandler;
use App\Infrastructure\Controller\AuthorizationTrait;
use App\Domain\Blog\Presenter\CreatePostPresenterInterface;
use App\Domain\Blog\Responder\CreatePostResponder;
use App\Domain\Blog\Responder\RedirectCreatePostResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Create
{
    use AuthorizationTrait;

    /**
     * @param Request $request
     * @param PostHandler $postHandler
     * @param CreatePostPresenterInterface $presenter
     * @return Response
     * @throws \Exception
     */
    public function __invoke(
        Request $request,
        PostHandler $postHandler,
        CreatePostPresenterInterface $presenter
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $post = new Post();

        $options = [
            "validation_groups" => ["Default", "create"]
        ];

        if($postHandler->handle($request, $post, $options)) {
            return $presenter->redirect(new RedirectCreatePostResponder($post));
        }

        return $presenter->present(new CreatePostResponder($postHandler->createView()));
    }
}