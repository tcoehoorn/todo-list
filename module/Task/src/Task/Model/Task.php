<?php

namespace Task\Model;

/**
 * Task model
 *
 */
class Task
{
    /** @var int $id task id */
    private $id;

    /** @var string $description task description */
    private $description;

    /** @var string $date due date */
    private $date;

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

    /**
     * Get id
     *
     * @return int task id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param int $id task id
     *
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get description
     *
     * @return string description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description description
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get due date
     *
     * @return string due date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set due date
     *
     * @param string $date due date
     *
     * @return void
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}
