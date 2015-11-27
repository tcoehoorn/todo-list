<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Task\Model\Task;

/**
 * Task Tracker controller
 *
 */
class IndexController extends AbstractActionController
{
    /** @var Task\Model\TaskTable task table model */
    protected $taskTable;

    /**
     * Display task list
     *
     * @return void
     */
    public function indexAction()
    {
        $taskResults = $this->getTaskTable()->fetchAll();
        
        $tasks = array();

        foreach ($taskResults as $task) {
            $tasks[$task->getId()] = $task->toArray();
        }

        return new ViewModel(array(
            'tasks' => $tasks,
        ));
    }

    /**
     * Save task
     *
     * @return void
     */
    public function saveTaskAction()
    {
        $request = $this->getRequest();
	    
	    $description = $request->getPost('description');
	    $date = $request->getPost('date');

        if (!empty($description) && !empty($date)) {
            $taskTable = $this->getTaskTable();
            $task = new Task();

            $task->setDescription($description);
            $task->setDate($date);

            $id = $request->getPost('id');

            if (is_numeric($id)) {
                $task->setId($id);
            }

            $id = $taskTable->saveTask($task);
        }

        return new JsonModel(array(
            'id'          => $id,
            'description' => $description,
            'date'        => $date,
        ));
    }

    /**
     * Get task table model
     *
     * @return Task\Model\TaskTable
     */
    public function getTaskTable()
    {
        if (!$this->taskTable) {
            $sm = $this->getServiceLocator();
            $this->taskTable = $sm->get('Task\Model\TaskTable');
        }
        return $this->taskTable;
    }
}
