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

class IndexController extends AbstractActionController
{
    protected $taskTable;

    public function indexAction()
    {
        return new ViewModel(array(
            'tasks' =>  $this->getTaskTable()->fetchAll(),
        ));
    }

    public function createTaskAction()
    {
        $request = $this->getRequest();
	    
	    $data = $request->getPost();

        return new JsonModel(array(
            'test' => 'hello',
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
