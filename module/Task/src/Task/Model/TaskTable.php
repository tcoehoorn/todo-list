<?php
namespace Task\Model;

use Zend\Db\TableGateway\TableGateway;

class TaskTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getTask($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveTask(Task $task)
    {
        $data = array(
            'description' => $task->description,
            'date'  => $task->date,
        );

        $id = (int) $task->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getTask($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Task id does not exist');
            }
        }
    }

    public function deleteTask($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
