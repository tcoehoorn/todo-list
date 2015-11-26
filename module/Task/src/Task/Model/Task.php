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
}
