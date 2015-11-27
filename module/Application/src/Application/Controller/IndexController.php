<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Task\Model\Task;

class IndexController extends AbstractActionController
{
    protected $taskTable;

    public function indexAction()
    {
        $taskResults = $this->getTaskTable()->fetchAll();
        
        $tasks = array();

        foreach ($taskResults as $task) {
            $tasks[] = $task->toArray();
        }

        return new ViewModel(array(
            'tasks' => $tasks,
        ));
    }

    public function saveTaskAction()
    {
        $request = $this->getRequest();
	    
	    $description = $request->getPost('description');
	    $date = $request->getPost('date');

        if (!empty($description) && !empty($date)) {
            $taskTable = $this->getTaskTable();
            $task = new Task();

            $task->description = $description;
            $task->date = $date;

            $id = $request->getPost('id');

            if (is_numeric($id)) {
                $task->id = $id;
            }

            $taskTable->saveTask($task);
        }

        return new JsonModel(array(
            'id'          => $id,
            'description' => $description,
            'date'        => $date,
        ));
    }

    public function getTaskTable()
    {
        if (!$this->taskTable) {
            $sm = $this->getServiceLocator();
            $this->taskTable = $sm->get('Task\Model\TaskTable');
        }
        return $this->taskTable;
    }
}
