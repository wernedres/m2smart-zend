<?php


namespace M2smart\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repo = $em->getRepository('M2smart\Entity\Setor');
        $setores = $repo->findAll();
        return new ViewModel(array('setores' => $setores));
    }

}
