<?php

namespace App\Domain\Blog\DataTransferObject;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Comment
 * @package App\Domain\Blog\DataTransferObject
 */
class Comment
{
    /**
     * @var string|null
     * @Assert\NotBlank(groups={"anonymous"})
     * @Assert\Length(min=2, groups={"anonymous"})
     */
    private ?string $author = null;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     */
    private ?string $content = null;

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     */
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
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
