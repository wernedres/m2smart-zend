<?php

namespace M2smartAdmin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use M2smartAdmin\Form\Login as LoginForm;
use Zend\Authentication\Storage\Session as SessionStorage;

class AuthController extends AbstractActionController {

    public function indexAction() {

        $form = new LoginForm;
        $error = false;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {// vericando se o formulario é valido
                $data = $request->getPost()->toArray();
             // aqui vai o processo de authenticaçao do zend framework
                $auth = new AuthenticationService;

                $sessionStorage = new SessionStorage("M2smartAdmin"); //setando namespace da sessionStorage
                $auth->setStorage($sessionStorage); //aplicando sessionStorage na aplicação

                $authAdapter = $this->getServiceLocator()->get('M2smart\Auth\Adapter');
                $authAdapter->setUsername($data['login'])
                        ->setSenha($data['senha']);

                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $sessionStorage->write($auth->getIdentity()['usuario'], null); //gravando essa entidade user no sessionStorage
                    return $this->redirect()->toRoute("m2smart-admin", array('controller' => 'setores')); //se o usuario se autenticar sera redirecionado para paginas de setores
                } else {
                    $error = true;
                }
            }
        }
        return new ViewModel(array('form' => $form, 'error' => $error));
    }

//    //criando Método de Logout 
    public function logoutAction() {
        $auth = new AuthenticationService; //pegando a autenticação
        $auth->setStorage(new SessionStorage('M2smartAdmin')); //setando o storage e tratando da autenticação da M2smarAdmin
        $auth->clearIdentity(); //Limpa a indentidade do camarada  e o cara não esta mais logado no sittema

        return $this->redirect()->toRoute('m2smart-home');
    }

    }