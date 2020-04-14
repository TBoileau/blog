<?php

namespace App\Application\DataFixtures;

use App\Application\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserFixtures
 * @package App\Application\DataFixtures
 */
class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setEmail(sprintf("email+%d@email.com", $i));
            $user->setPseudo(sprintf("pseudo+%d", $i));
            $user->setPassword($this->userPasswordEncoder->encodePassword($user, "password"));
            $manager->persist($user);
            $this->setReference(sprintf("user-%d", $i), $user);
        }
        $manager->flush();
    }
}
