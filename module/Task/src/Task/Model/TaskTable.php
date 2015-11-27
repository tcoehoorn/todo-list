<?php
namespace Task\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Task table model
 *
 */
class TaskTable
{
    /** @var TableGateway table gateway */
    protected $tableGateway;

    /**
     * Initialize class
     *
     * @param TableGateway $tableGateway task table gateway
     *
     * @return void
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


    /**
     * Get all tasks
     *
     * @return Zend\Db\ResultSet all tasks
     */
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    /**
     * Get task
     *
     * @param int $id task id
     *
     * @return Task\Model\Task task asssociated with id
     */
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

    /**
     * Save task
     *
     * @param Task $task task
     *
     * @return void
     */
    public function saveTask(Task $task)
    {
        $data = array(
            'description' => $task->getDescription(),
            'date'  => $task->getDate(),
        );

        $id = (int) $task->getId();
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

    /**
     * Delete task
     *
     * @param int $id task id
     */
    public function deleteTask($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
