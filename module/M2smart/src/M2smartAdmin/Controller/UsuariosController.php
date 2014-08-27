<?php

namespace M2smartAdmin\Controller;

use Zend\View\Model\ViewModel;

class UsuariosController extends CrudController {

    public function __construct() {

        $this->entity = "M2smart\Entity\Usuario";
        $this->form = "M2smartAdmin\Form\Usuario";
        $this->service = "M2smart\Service\Usuario";
        $this->controller = "usuarios";
        $this->route = "m2smart-admin";
    }

    public function editAction() {
        $form = new $this->form();
        $request = $this->getRequest();

        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));

        if ($this->params()->fromRoute('id', 0)) {
            $array = $entity->toArray();
            unset($array['senha']);// aqui nessa linha , o unset faz com  que o campo venha em branco na hora da edição
            $form->setData($array);
        }

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $res = $service->update($request->getPost()->toArray());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller ));
            }
        }
        return new ViewModel(array('form' => $form));
    }

}
