<?php

namespace App\Application\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Application\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @ORM\Column(unique=true)
     */
    private ?string $email = null;

    /**
     * @var string|null
     * @ORM\Column
     */
    private ?string $password = null;

    /**
     * @var string|null
     * @ORM\Column(unique=true)
     */
    private ?string $pseudo = null;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $registeredAt;

    /**
     * User constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->registeredAt = new DateTimeImmutable();
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

    /**
     * @return DateTimeImmutable
     */
    public function getRegisteredAt(): DateTimeImmutable
    {
        return $this->registeredAt;
    }

    /**
     * @param DateTimeImmutable $registeredAt
     */
    public function setRegisteredAt(DateTimeImmutable $registeredAt): void
    {
        $this->registeredAt = $registeredAt;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }
}
