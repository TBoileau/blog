<?php

namespace App\Domain\User\DataTransferObject;

use App\Application\Validator\{
    UniquePseudo,
    UniqueEmail
};
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package App\Domain\User\DataTransferObject
 */
class User
{
    /**
     * @var string|null
     * @Assert\Email
     * @Assert\NotBlank
     * @UniqueEmail
     */
    private ?string $email = null;

    /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Length(min=8)
     */
    private ?string $password = null;

    /**
     * @var string|null
     * @Assert\NotBlank
     * @UniquePseudo
     */
    private ?string $pseudo = null;

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    /**
     * @param string|null $pseudo
     */
    public function setPseudo(?string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }
}
