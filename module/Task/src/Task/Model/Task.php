<?php

namespace Task\Model;

/**
 * Task model
 *
 */
class Task
{
    /** @var int $id task id */
    public $id;

    /** @var string $description task description */
    public $description;

    /** @var string $date due date */
    public $date;

    /**
     * Transfer array data to class variables
     *
     * @param array $data task data
     *
     * @return void
     */
    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->date  = (!empty($data['date'])) ? $data['date'] : null;
    }

    /**
     * Get array representation of class
     *
     * @return array task data
     */
    public function toArray()
    {
        return array($this->id, $this->description, $this->date);
    }
}
