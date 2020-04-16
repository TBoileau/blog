<?php

namespace App\Domain\Security\DataTransferObject;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Credentials
 * @package App\Domain\Security\DataTransferObject
 */
class Credentials
{
    /**
     * @var string|null
     * @Assert\NotBlank
     */
    private ?string $username = null;

    /**
     * @var string|null
     * @Assert\NotBlank
     */
    private ?string $password = null;

    /**
     * Credentials constructor.
     * @param string|null $username
     */
    public function __construct(?string $username = null)
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
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
}
