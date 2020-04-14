<?php

namespace App\Domain\Blog\Responder;

use App\Application\Entity\Post;

/**
 * Class AbstractRedirectPostResponder
 * @package App\Domain\Blog\Responder
 */
class AbstractRedirectPostResponder
{
    /**
     * @var Post
     */
    private Post $post;

    /**
     * RedirectReadPostResponder constructor.
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }
}