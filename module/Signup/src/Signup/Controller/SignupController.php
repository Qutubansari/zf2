<?php
namespace Signup\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Signup\Form\SignupForm;
use Signup\Model\Signup;
use Zend\Session\Container;
use Zend\EventManager\EventManagerInterface;
/**
 * signupController
 *
 * @author
 *
 * @version
 *
 */
class SignupController extends AbstractActionController
{

    /**
     * The default action - show the home page
     */
    public function setEventManager(EventManagerInterface $events)
    {
        parent::setEventManager($events);
        $controller = $this;
        $events->attach('dispatch', function ($e) use ($controller) {
            $controller->layout('layout/public');
        }, 100);
    }
    
    public function indexAction()
    {
        // TODO Auto-generated signupController::indexAction() default action
        return new ViewModel();
    }
    
    public function signupAction()
    {
        $sessionObj = new Container('DATA');
        $form = new \Signup\Form\SignupForm();
        $form->get('submit')->setValue('signup');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $signup = new \Signup\Model\Signup();
            $form->setInputFilter($signup->getInputFilter());
            $form->setData($request->getPost());
    
            if ($form->isValid()) {
                $signup->exchangeArray($form->getData());
    
                $sessionObj->emailid = $signup->email;
    
                $this->getSignupTable()->enterDetails($signup); // to enter data in table
    
                return $this->redirect()->toRoute('dashboard');
            }
        }
    
        return array(
            'form' => $form
        );
    }
    /**
     * The getSignupTable action - retruns the signup table instance
     */
    public function getSignupTable()
    {
        if (! $this->signupTable) {
            $sm = $this->getServiceLocator();
            $this->signupTable = $sm->get('Signup\Model\SignupTable');
        }
        return $this->signupTable;
    }
}