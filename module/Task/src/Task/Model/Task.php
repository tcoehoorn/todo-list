<?php

namespace Task\Model;

class Task
{
    public $id;
    public $description;
    public $date;

    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->description = (!empty($data['description'])) ? $data['description'] : null;
        $this->date  = (!empty($data['date'])) ? $data['date'] : null;
    }

    public function toArray()
    {
        //return array('id' => $this->id, 'description' => $this->description, 'date' => $this->date);
        return array($this->id, $this->description, $this->date);

    }
}
