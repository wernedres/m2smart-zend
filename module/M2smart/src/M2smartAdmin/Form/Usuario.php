<?php

namespace M2smartAdmin\Form;

use Zend\Form\Form;

class Usuario extends Form {

    public function __construct($name = null) {
        parent::__construct('user');

        $this->setAttribute('method', 'post');
        #$this->setInputFilter(new UserFilter);

        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden'
            )
        ));

      
    
        $this->add(array(
            'name' => 'nome',
            'options' => array(
                'type' => 'text',
                'label' => 'Nome'
            ),
            'attributes' => array(
                'placeholder' => 'Entre com o nome'
            )
        ));
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
                'type' => 'password'
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn-success'
            )
        ));
    }

}
