<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Form\CommentType;
use App\Form\PostType;
use App\Paginator\CommentPaginator;
use App\Paginator\PostPaginator;
use App\Repository\PostRepository;
use App\Representation\Representation;
use App\Representation\RepresentationBuilderInterface;
use App\Representation\RepresentationFactoryInterface;
use App\Representation\RepresentationInterface;
use App\Security\Voter\PostVoter;
use App\Uploader\UploaderInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlogController
 * @package App\Controller
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @param RepresentationFactoryInterface $representationFactory
     * @return Response
     */
    public function index(Request $request, RepresentationFactoryInterface $representationFactory): Response
    {
        $representation = $representationFactory->create(PostPaginator::class)->handleRequest($request);

        return $this->render("blog/index.html.twig", [
            "representation" => $representation->paginate()
        ]);
    }

    /**
     * @Route("/article-{id}", name="blog_read")
     * @param Post $post
     * @param Request $request
     * @param RepresentationFactoryInterface $representationFactory
     * @return Response
     * @throws \Exception
     */
    public function read(Post $post, Request $request, RepresentationFactoryInterface $representationFactory): Response
    {
        $representation = $representationFactory->create(CommentPaginator::class)->handleRequest($request);

        $comment = new Comment();
        $comment->setPost($post);

        if ($this->isGranted("ROLE_USER")) {
            $comment->setUser($this->getUser());
        }

        $form = $this->createForm(CommentType::class, $comment, [
            "validation_groups" => $this->isGranted("ROLE_USER") ? "Default" : ["Default", "anonymous"]
        ])->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("blog_read", ["id" => $post->getId()]);
        }

        return $this->render("blog/read.html.twig", [
            "post" => $post,
            "form" => $form->createView(),
            "representation" => $representation->paginate([
                "post" => $post,
                "route_params" => [
                    "id" => $post->getId()
                ]
            ])
        ]);
    }

    /**
     * @Route("/publier-article", name="blog_create")
     * @param Request $request
     * @param UploaderInterface $uploader
     * @return Response
     * @throws \Exception
     */
    public function create(
        Request $request,
        UploaderInterface $uploader
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $post = new Post();
        $post->setUser($this->getUser());

        $form = $this->createForm(PostType::class, $post, [
            "validation_groups" => ["Default", "create"]
        ])->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get("file")->getData();

            $post->setImage($uploader->upload($file));

            $this->getDoctrine()->getManager()->persist($post);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("blog_read", ["id" => $post->getId()]);
        }

        return $this->render("blog/create.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/modifier-article/{id}", name="blog_update")
     * @param Request $request
     * @param Post $post
     * @param UploaderInterface $uploader
     * @return Response
     */
    public function update(
        Request $request,
        Post $post,
        UploaderInterface $uploader
    ): Response {
        $this->denyAccessUnlessGranted(PostVoter::EDIT, $post);

        $form = $this->createForm(PostType::class, $post)->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get("file")->getData();

            if ($file !== null) {
                $post->setImage($uploader->upload($file));
            }

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("blog_read", ["id" => $post->getId()]);
        }

        return $this->render("blog/update.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
