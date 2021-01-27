<?php

declare(strict_types=1);

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class CanImpersonateVoter extends Voter
{
    protected function supports(string $attribute, $subject)
    {
        return $attribute === 'CAN_IMPERSONATE' && $subject instanceof User;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof User) {
            return false;
        }

        assert($subject instanceof User);

        return self::isSubordinate($user, $subject);
    }

    /** Recursively check if $subordinate is subordinate of $user */
    protected static function isSubordinate(User $user, User $subordinate): bool
    {
        if ($user->getSubordinates()->contains($subordinate)) {
            return true;
        }
        foreach ($user->getSubordinates() as $directSubordinate) {
            if (self::isSubordinate($directSubordinate, $subordinate)) {
                return true;
            }
        }
        return false;
    }
}