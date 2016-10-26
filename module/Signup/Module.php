<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Signup for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Signup;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Signup\Model\Signup;
use Signup\Model\SignupTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\ModuleManager;
use Signup\Module\Menu;
use Signup\Model\MenuTable;
use Signup\Model\RoleTable;
use Signup\Model\UserRoleTable;
use Signup\Model\RoleMenuTable;

class Module implements AutoloaderProviderInterface
{
    
    
    public function init(ModuleManager $manager)
    {
        $events = $manager->getEventManager();
        $sharedEvents = $events->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function ($e) {
            $controller = $e->getTarget();
            // if (get_class($controller) == 'Login\Controller\IndexController') {
            $controller->layout('layout/public');
            // }
        }, 100);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__)
                )
            )
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Signup\Model\SignupTable' => function ($sm) {
                    $tableGateway = $sm->get('SignupTableGateway');
                    
                    $table = new SignupTable($tableGateway);
                    
                    return $table;
                },
                'SignupTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Signup());
                    
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
                'Signup\Model\MenuTable' => function ($sm) {
                $tableGateway = $sm->get('MenuTableGateway');
                $table = new MenuTable($tableGateway);
                return $table;
                },
                'MenuTableGateway' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new \Signup\Model\Menu());
                return new TableGateway('menu', $dbAdapter, null, $resultSetPrototype);
                },
                'Signup\Model\RoleTable' => function ($sm) {
                $tableGateway = $sm->get('RoleTableGateway');
                $table = new RoleTable($tableGateway);
                return $table;
                },
                'RoleTableGateway' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new \Signup\Model\Role());
                return new TableGateway('role', $dbAdapter, null, $resultSetPrototype);
                },
                'Signup\Model\RoleTable' => function ($sm) {
                $tableGateway = $sm->get('RoleTableGateway');
                $table = new RoleTable($tableGateway);
                return $table;
                },
                'RoleTableGateway' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new \Signup\Model\Role());
                return new TableGateway('role', $dbAdapter, null, $resultSetPrototype);
                },
                'Signup\Model\UserRoleTable' => function ($sm) {
                $tableGateway = $sm->get('UserRoleTableGateway');
                $table = new UserRoleTable($tableGateway);
                return $table;
                },
                'UserRoleTableGateway' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new \Signup\Model\UserRole());
                return new TableGateway('user_role', $dbAdapter, null, $resultSetPrototype);
                },
                'Signup\Model\RoleMenuTable' => function ($sm) {
                $tableGateway = $sm->get('RoleMenuTableGateway');
                $table = new RoleMenuTable($tableGateway);
                return $table;
                },
                'RoleMenuTableGateway' => function ($sm) {
                $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                $resultSetPrototype = new ResultSet();
                $resultSetPrototype->setArrayObjectPrototype(new \Signup\Model\RoleMenu());
                return new TableGateway('role_menu', $dbAdapter, null, $resultSetPrototype);
                },
            )
            
        );
    }
}
