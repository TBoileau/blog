<?php

namespace App\Infrastructure\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class TransferEvent
 * @package App\Infrastructure\Event
 */
class TransferEvent extends Event
{
    const NAME = "app.event.transfer";

    /**
     * @var object
     */
    private object $originalData;

    /**
     * @var object
     */
    private object $data;

    /**
     * TransferEvent constructor.
     * @param object $originalData
     * @param object $data
     */
    public function __construct(object $originalData, object $data)
    {
        $this->originalData = $originalData;
        $this->data = $data;
    }

    /**
     * @return object
     */
    public function getOriginalData(): object
    {
        return $this->originalData;
    }

    /**
     * @return object
     */
    public function getData(): object
    {
        return $this->data;
    }
}
