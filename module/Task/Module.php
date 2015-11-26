<?php

namespace Task;

// Add these import statements:
use Task\Model\Task;
use Task\Model\TaskTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    // getAutoloaderConfig() and getConfig() methods here
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    // Add this method:
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Task\Model\TaskTable' =>  function($sm) {
                    $tableGateway = $sm->get('TaskTableGateway');
                    $table = new TaskTable($tableGateway);
                    return $table;
                },
                'TaskTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Task());
                    return new TableGateway('task', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
