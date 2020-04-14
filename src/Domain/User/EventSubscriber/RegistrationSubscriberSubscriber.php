<?php

namespace App\Domain\User\EventSubscriber;

use App\Application\Entity\User;
use App\Infrastructure\Event\ReverseEvent;
use App\Infrastructure\Event\TransferEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegistrationSubscriberSubscriber
 * @package App\Domain\User\EventSubscriber
 */
class RegistrationSubscriberSubscriber implements EventSubscriberInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;

    /**
     * RegistrationSubscriberSubscriber constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            TransferEvent::NAME => "onTransfer",
            ReverseEvent::NAME => "onReverse"
        ];
    }

    /**
     * @param TransferEvent $event
     */
    public function onTransfer(TransferEvent $event): void
    {
        return;
    }

    /**
     * @param ReverseEvent $event
     */
    public function onReverse(ReverseEvent $event): void
    {
        if (!$event->getOriginalData() instanceof User) {
            return;
        }

        $event->getOriginalData()->setPseudo($event->getData()->getPseudo());
        $event->getOriginalData()->setPassword(
            $this->userPasswordEncoder->encodePassword($event->getOriginalData(), $event->getData()->getPassword())
        );
        $event->getOriginalData()->setEmail($event->getData()->getEmail());
    }
}
