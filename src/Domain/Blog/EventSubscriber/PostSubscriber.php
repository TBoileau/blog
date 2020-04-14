<?php

namespace App\Domain\Blog\EventSubscriber;

use App\Application\Entity\Post;
use App\Infrastructure\Event\ReverseEvent;
use App\Infrastructure\Event\TransferEvent;
use App\Infrastructure\Uploader\UploaderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class PostSubscriber
 * @package App\Domain\Blog\EventSubscriber
 */
class PostSubscriber implements EventSubscriberInterface
{
    /**
     * @var Security
     */
    private Security $security;

    /**
     * @var UploaderInterface
     */
    private UploaderInterface $uploader;

    /**
     * PostSubscriber constructor.
     * @param Security $security
     * @param UploaderInterface $uploader
     */
    public function __construct(Security $security, UploaderInterface $uploader)
    {
        $this->security = $security;
        $this->uploader = $uploader;
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
        if (!$event->getOriginalData() instanceof Post) {
            return;
        }

        $event->getData()->setTitle($event->getOriginalData()->getTitle());
        $event->getData()->setContent($event->getOriginalData()->getContent());
    }

    /**
     * @param ReverseEvent $event
     */
    public function onReverse(ReverseEvent $event): void
    {
        if (!$event->getOriginalData() instanceof Post) {
            return;
        }

        if ($event->getData()->getImage() !== null) {
            $event->getOriginalData()->setImage($this->uploader->upload($event->getData()->getImage()));
        }

        $event->getOriginalData()->setUser($this->security->getUser());
        $event->getOriginalData()->setTitle($event->getData()->getTitle());
        $event->getOriginalData()->setContent($event->getData()->getContent());
    }
}
