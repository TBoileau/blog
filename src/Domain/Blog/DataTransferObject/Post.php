<?php

namespace App\Domain\Blog\DataTransferObject;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Post
 * @package App\Domain\Blog\DataTransferObject
 */
class Post
{
    /**
     * @var string|null
     * @Assert\NotBlank
     */
    private ?string $title = null;

    /**
     * @var UploadedFile|null
     * @Assert\NotNull(groups={"create"})
     * @Assert\Image
     */
    private ?UploadedFile $image = null;

    /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Length(min=10)
     */
    private ?string $content = null;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return UploadedFile|null
     */
    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    /**
     * @param UploadedFile|null $image
     */
    public function setImage(?UploadedFile $image): void
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
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }
}
