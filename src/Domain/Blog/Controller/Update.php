<?php


namespace App\Domain\Blog\Controller;


use App\Application\Entity\Post;
use App\Application\Security\Voter\PostVoter;
use App\Domain\Blog\Handler\PostHandler;
use App\Infrastructure\Controller\AuthorizationTrait;
use App\Domain\Blog\Presenter\UpdatePostPresenterInterface;
use App\Domain\Blog\Responder\RedirectUpdatePostResponder;
use App\Domain\Blog\Responder\UpdatePostResponder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Update
{
    use AuthorizationTrait;

    /**
     * @param Request $request
     * @param Post $post
     * @param PostHandler $postHandler
     * @param UpdatePostPresenterInterface $presenter
     * @return Response
     */
    public function __invoke(
        Request $request,
        Post $post,
        PostHandler $postHandler,
        UpdatePostPresenterInterface $presenter
    ): Response {
        $this->denyAccessUnlessGranted(PostVoter::EDIT, $post);

        if($postHandler->handle($request, $post)) {
            return $presenter->redirect(new RedirectUpdatePostResponder($post));
        }

        return $presenter->present(new UpdatePostResponder($postHandler->createView()));
    }
}