<?php

namespace App\Application\Entity;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Application\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @var string|null
     * @ORM\Column
     */
    private ?string $title = null;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $publishedAt;

    /**
     * @var string|null
     * @ORM\Column
     */
    private ?string $image = null;

    /**
     * @var string|null
     * @ORM\Column(type="text")
     */
    private ?string $content = null;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     */
    private User $user;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    private Collection $comments;

    /**
     * Post constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->publishedAt = new DateTimeImmutable();
        $this->comments = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getPublishedAt(): DateTimeImmutable
    {
        return $this->publishedAt;
    }

    /**
     * @param DateTimeImmutable $publishedAt
     */
    public function setPublishedAt(DateTimeImmutable $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Collection
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }
}
