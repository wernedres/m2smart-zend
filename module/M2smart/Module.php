<?php

namespace M2smart;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use M2smart\Service\Setor as SetorService;
use M2smart\Service\Funcionario as FuncionarioService;
use M2smart\Service\Usuario as UsuarioService;
use M2smartAdmin\Form\Funcionario as FuncionarioFrm;

class Module
{
    public function getConfig()
    {
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
         
                }
            ),
        );
    }
    


}

    

