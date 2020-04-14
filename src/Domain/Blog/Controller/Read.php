<?php

namespace App\Domain\Blog\Controller;

use App\Application\Entity\Comment;
use App\Application\Entity\Post;
use App\Domain\Blog\Handler\CommentHandler;
use App\Infrastructure\Controller\AuthorizationTrait;
use App\Infrastructure\Representation\RepresentationFactoryInterface;
use App\Domain\Blog\Paginator\CommentPaginator;
use App\Domain\Blog\Presenter\ReadPostPresenterInterface;
use App\Domain\Blog\Responder\ReadPostResponder;
use App\Domain\Blog\Responder\RedirectReadPostResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Read
{
    use AuthorizationTrait;

    /**
     * @param Post $post
     * @param Request $request
     * @param RepresentationFactoryInterface $representationFactory
     * @param CommentHandler $commentHandler
     * @param ReadPostPresenterInterface $presenter
     * @return Response
     * @throws \Exception
     */
    public function __invoke(
        Post $post,
        Request $request,
        RepresentationFactoryInterface $representationFactory,
        CommentHandler $commentHandler,
        ReadPostPresenterInterface $presenter
    ): Response {
        $representation = $representationFactory->create(CommentPaginator::class)->handleRequest($request);

        $comment = new Comment();
        $comment->setPost($post);

        $options = [
            "validation_groups" => $this->isGranted("ROLE_USER") ? "Default" : ["Default", "anonymous"]
        ];

        if($commentHandler->handle($request, $comment, $options)) {
            return $presenter->redirect(new RedirectReadPostResponder($post));
        }

        return $presenter->present(new ReadPostResponder(
            $post,
            $representation->paginate([
                "post" => $post,
                "route_params" => [
                    "id" => $post->getId()
                ]
            ]),
            $commentHandler->createView()
        ));
    }
}