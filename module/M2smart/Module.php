<?php

namespace M2smart;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use M2smart\Service\Setor as SetorService;

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
            'Livraria\Model\CategoriaService' => function($service) {
            $dbAdapter = $service->get('Zend\Db\Adapter\Adapter');
            $categoriaTable = new CategoriaTable($dbAdapter);
            $categoriaService = new Model\CategoriaService($categoriaTable);
            return $categoriaService;
            
  },
                'M2smart\Service\Setor' => function($service) {
            return new SetorService($service->get('Doctrine\ORM\EntityManager'));
         
                }
            ),
        );
    }
    


}

    

