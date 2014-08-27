<?php

namespace M2smart;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\ModuleManager\ModuleManager;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use M2smart\Service\Setor as SetorService;
use M2smart\Service\Funcionario as FuncionarioService;
use M2smart\Service\Usuario as UsuarioService;
use M2smartAdmin\Form\Funcionario as FuncionarioFrm;

use M2smart\Auth\Adapter as AuthAdapter;

class Module{
    public function getConfig(){
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    { 
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__. 'Admin' => __DIR__ . '/src/' . __NAMESPACE__. "Admin",
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
     public function onBootstrap($e)
{
$e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
$controller = $e->getTarget();
$controllerClass = get_class($controller);
$moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
$config = $e->getApplication()->getServiceManager()->get('config');
if (isset($config['module_layouts'][$moduleNamespace])) {
$controller->layout($config['module_layouts'][$moduleNamespace]);
}
}, 100);
}
     public function init(ModuleManager $moduleManager) {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach("M2smartAdmin", 'dispatch', function($e) {
            $auth = new AuthenticationService;
            $auth->setStorage(new SessionStorage("M2smartAdmin"));

            $controller = $e->getTarget();
            $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();

            if (!$auth->hasIdentity() and ( $matchedRoute == "m2smart-admin" or $matchedRoute == "m2smart-admin-interna")) {
                return $controller->redirect()->toRoute('m2smart-admin-auth');
            }
        }, 99);
    }
    
    public function getServiceConfig() {
        return array(
            'factories' => array(
            
            'M2smart\Service\Setor' => function($service) {
            return new SetorService($service->get('Doctrine\ORM\EntityManager'));
         
                },
            'M2smart\Service\Funcionario' => function($service) {
            return new FuncionarioService($service->get('Doctrine\ORM\EntityManager'));
         
                },
            'M2smart\Service\Usuario' => function($service) {
            return new UsuarioService($service->get('Doctrine\ORM\EntityManager'));
         
                },
            'M2smartAdmin\Form\Funcionario' => function($service) {
               $em = $service->get('Doctrine\ORM\EntityManager');
               $repository = $em->getRepository('M2smart\Entity\Setor');
               $setores = $repository->fetchPairs();
                 
               return new FuncionarioFrm(null, $setores);
         
                },
               
            'M2smart\Auth\Adapter' => function($service) {
            return new AuthAdapter($service->get('Doctrine\ORM\EntityManager'));
         
                },
            ),
        );
    }
      public function getViewHelperConfig() {
        return array(
            'invokables' => array(
                'UserIdentity' => new View\Helper\UserIdentity()
            )
        );
    }
    


}

    

