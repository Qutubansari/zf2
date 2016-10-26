<?php
namespace Signup\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Zend\Mvc\MvcEvent;
use Signup\Form\MenuForm;
use Signup\Model\Menu;
use Signup\Form\RoleForm;
use Signup\Model\UserRole;
use Signup\Form\UserRoleForm;
use Signup\Form\RoleMenuForm;
use Signup\Model\RoleMenu;
/**
 * DashboardController
 *
 * @author
 *
 * @version
 *
 */
class DashboardController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    protected $menuTable;
    protected $roleTable;
    protected $userRoleTable;
    protected $roleMenuTable;
    public function indexAction()
    {
        // TODO Auto-generated DashboardController::indexAction() default action
        return new ViewModel();
    }
    
    public function onDispatch(MvcEvent $e)
    {
        parent::onDispatch($e);
     
        $sessionObj = new Container('APP_SESSION');
      
            $data1 = $this->getMenuTable()->parentList();
    
            $result = array();
            
        
            foreach ($data1 as $val) {
                if (isset($result[$val->parent])) {
                    $id = $val->parent;
                    \array_push($result[$id], $val->name);
                } else {
                    $result[$val->menu_id] = array(
                        'name' => $val->name
                    );
                }
            }
            $controllerObj = $e->getTarget();
            $controllerObj->getEvent()
            ->getViewModel()
            ->setVariables(array(
                'name' => $sessionObj->emailid,
                'menu' => $result
            ));
   
    }
    
    /**
     * The dashboard action - The home page of dashboard
     */
    public function dashboardAction()
    {
        $sessionObj = new Container('APP_SESSION');
        if (isset($sessionObj->emailid) === true) {
    
            $this->layout()->setVariable('name', $sessionObj->emailid);
    
            return array();
        } else
            return new ViewModel();
    }
    
 
    
    /**
     * The add action - add the menu,route and parent
     */
    public function addAction()
    {
        
        $form = new \Signup\Form\MenuForm();
        $form->get('submit')->setValue('Add');
    
        $result = $this->getMenuTable()->parent();
        $array1 = array();
        $array1['NO PARENT'] = 'NO PARENT';
        foreach ($result as $res) {
            $array1[$res->menu_id] = $res->name;
        }
        $form->get('parent')->setAttribute('options', $array1);
    
        $request = $this->getRequest();
        if ($request->isPost()) {
            $login = new \Signup\Model\Menu();
            $form->setInputFilter($login->getInputFilter());
            $form->setData($request->getPost());
    
            if ($form->isValid()) {
                $login->exchangeArray($form->getData());
                $this->getMenuTable()->enterDetails($login); // to enter data in table
                return $this->redirect()->toRoute('list');
            }
        }
        
        return array(
            'form' => $form
        );
    }
    
    /**
     * The list action - show the list of all the menus in menu table
     */
    public function listAction()
    {
        $data = $this->getMenuTable()->parentList();
        return array(
            'data' => $data
        );
    }
    
    /**
     * The default action - returns the instance of menu table
     */
    public function getMenuTable()
    {
        if (! $this->menuTable) {
            $sm = $this->getServiceLocator();
            $this->menuTable = $sm->get('Signup\Model\MenuTable');
        }
        return $this->menuTable;
    }
    
    
    public function addRoleAction()
    {
        $form = new RoleForm();
        $form->get('submit')->setValue('Add');
        
       
        
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $login = new \Signup\Model\Role();
            $form->setInputFilter($login->getInputFilter());
            $form->setData($request->getPost());
        
            if ($form->isValid()) {
                $login->exchangeArray($form->getData());
                $this->getRoleTable()->enterDetails($login); // to enter data in table
                return $this->redirect()->toRoute('listRole');
            }
        }
        
        return array(
            'form' => $form
        );
    }
    
    
    public function listRoleAction()
    {
//         $data = $this->getRoleTable()->roleList();
//         return array(
//             'data' => $data
//         );
        $paginator = $this->getRoleTable()->fetchAll(true);
        // set the current page to what has been passed in query string, or to 1 if none set
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        // set the number of items per page to 10
        $paginator->setItemCountPerPage(1);
        
        return new ViewModel(array(
            'paginator' => $paginator
        ));
    }
    
 public function addUserRoleAction()
    {
        $msg=false;
        $form = new UserRoleForm('User Role');
    
        $result = $this->getSignupTable()->fetchAll();
        
        $array1[0] = "enter user";
        foreach ($result as $res) {
        
            $array1[$res->user_id] = $res->username;
        
        }
        
        $form->get('user')->setAttribute('options', $array1);
        
        $result1 = $this->getRoleTable()->fetchAll();
        $array2[0] = "enter role";
        foreach ($result1 as $res) {
            
            $array2[$res->id] = $res->role;
       
        }
        
        $form->get('role')->setAttribute('options', $array2);
    
        $request = $this->getRequest();
    
    
    
        if ($request->isPost()) {
    
    
            $role = new UserRole();
            $form->setInputFilter($role->getInputFilter());
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                
                $role->exchangeArray($form->getData());
   
                $this->getUserRoleTable()->save($role);
                $msg='Users role added successfully';
                //return $this->redirect()->toRoute('list');
            }
          
        }
        return array(
            'form' => $form,
            'msg'=>$msg
        );
    
    
    
    
    }
    
    public function addRoleMenuAction()
    {
        $msg=false;
        $form = new RoleMenuForm('Role Menu');
    
        $result = $this->getRoleTable()->fetchAll();
    
        $array1[0] = "enter Role";
        foreach ($result as $res) {
    
            $array1[$res->id] = $res->role;
    
        }
    
        $form->get('role')->setAttribute('options', $array1);
    
        $result1 = $this->getMenuTable()->parentList();
        $array2[0] = "enter Menu";
        foreach ($result1 as $res) {
    
            $array2[$res->menu_id] = $res->name;
             
        }
    
        $form->get('menu')->setAttribute('options', $array2);
    
        $request = $this->getRequest();
    
    
    
        if ($request->isPost()) {
    
    
            $role = new RoleMenu();
            $form->setInputFilter($role->getInputFilter());
            $form->setData($request->getPost());
    
            if ($form->isValid()) {
    
                $role->exchangeArray($form->getData());
                 
                $this->getRoleMenuTable()->save($role);
                $msg='Users role added successfully';
                //return $this->redirect()->toRoute('list');
            }
    
        }
        return array(
            'form' => $form,
            'msg'=>$msg
        );
    
    
    
    
    }
    public function getRoleTable()
    {
        if (! $this->roleTable) {
            $sm = $this->getServiceLocator();
            $this->roleTable = $sm->get('Signup\Model\RoleTable');
        }
        return $this->roleTable;
    }
    
    public function getUserRoleTable()
    {
        if (! $this->userRoleTable) {
            $sm = $this->getServiceLocator();
            $this->userRoleTable = $sm->get('Signup\Model\userRoleTable');
        }
        return $this->userRoleTable;
    }
    
    public function getSignupTable()
    {
        if (! $this->signupTable) {
            $sm = $this->getServiceLocator();
            $this->signupTable = $sm->get('Signup\Model\SignupTable');
        }
        return $this->signupTable;
    }
    
    public function getRoleMenuTable()
    {
        if (! $this->roleMenuTable) {
            $sm = $this->getServiceLocator();
            $this->roleMenuTable = $sm->get('Signup\Model\roleMenuTable');
        }
        return $this->roleMenuTable;
    }
    
    
}