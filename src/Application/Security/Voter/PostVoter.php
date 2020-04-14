<?php

namespace App\Application\Security\Voter;

use App\Application\Entity\Post;
use App\Application\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Class PostVoter
 * @package App\Application\Security\Voter
 */
class PostVoter extends Voter
{
    public const EDIT = 'edit';

    /**
     * @inheritDoc
     */
    protected function supports(string $attribute, $subject)
    {
        if (!$subject instanceof Post) {
            return false;
        }

        if (!in_array($attribute, [self::EDIT])) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param Post $subject
     * @param TokenInterface $token
     * @return bool|void
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        /** @var User $user */
        $user = $token->getUser();

        switch ($attribute) {
            case self::EDIT:
                return $user === $subject->getUser();
                break;
        }
    }
}
