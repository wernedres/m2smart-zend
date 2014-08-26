<?php

namespace M2smartAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use M2smartAdmin\Form\Setor as FrmSetor;

class SetoresController extends AbstractActionController {

    /**
     * @var EntityManager
     */
    protected $em;

    public function indexAction() {

        $list = $this->getEm()
                ->getRepository('M2smart\Entity\Setor')
                ->findAll();

        return new ViewModel(array('data' => $list));
    }

    public function newAction() {
        $form = new FrmSetor();

        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                //rotina de inserir
                $service = $this->getServiceLocator()->get('M2smart\Service\Setor');
                $service->insert($request->getPost()->toArray());
                return $this->redirect()->toRoute('m2smart-admin', array('controller' => 'setores'));
            }
        }

        return new ViewModel(array('form' => $form));
    }

    public function editAction() {
        $form = new FrmSetor();
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository('M2smart\Entity\Setor');
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0))
            $form->setData($entity->toArray());

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $service = $this->getServiceLocator()->get('M2smart\Service\Setor');
                $service->update($request->getPost()->toArray());
                return $this->redirect()->toRoute('m2smart-admin', array('controller' => 'setores'));
            }
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction() {
        $service = $this->getServiceLocator()->get('M2smart\Service\Setor');
        if ($service->delete($this->params()->fromRoute('id', 0)))
            return $this->redirect()->toRoute('m2smart-admin', array('controller' => 'setores'));
    }

    /**
     * @return EntityManager
     */
    public function getEm() {
        if (null === $this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        return $this->em;
    }

}
