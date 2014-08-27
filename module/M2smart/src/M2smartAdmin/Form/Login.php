<?php

namespace M2smartAdmin\Form;

use Zend\Form\Form;

class Login extends Form {

    public function __construct($name = null) {
        parent::__construct('usuario');

        $this->setAttribute('method', 'post');
       
        $this->add(array(
            'name' => 'login',
            'options' => array(
                'type' => 'text',
                'label' => 'Login'
            ),
            'attributes' => array(
               'placeholder' => 'Entre com o Login'
            )
        ));
        $this->add(array(
            'name' => 'senha',
            'options' => array(
                'type' => 'Password',
                'label' => 'Senha'
            ),
            'attributes' => array(
                 'placeholder' => '****************************',
                'type' => 'password'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Login',
                'class' => 'btn-success'
            )
        ));
    }

}
