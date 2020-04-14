<?php

namespace App\Infrastructure\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class ReverseEvent
 * @package App\Infrastructure\Event
 */
class ReverseEvent extends Event
{
    const NAME = "app.event.reverse";

    /**
     * @var object
     */
    private object $data;

    /**
     * @var object
     */
    private object $originalData;

    /**
     * ReverseEvent constructor.
     * @param object $data
     * @param object $originalData
     */
    public function __construct(object $data, object $originalData)
    {
        $this->data = $data;
        $this->originalData = $originalData;
    }

    /**
     * @return object
     */
    public function getData(): object
    {
        return $this->data;
    }

    /**
     * @return object
     */
    public function getOriginalData(): object
    {
        return $this->originalData;
    }
}
