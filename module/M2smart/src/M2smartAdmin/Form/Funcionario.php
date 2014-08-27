<?php

namespace M2smartAdmin\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select;

class Funcionario extends Form {

    protected $setores;

    public function __construct($name = null, array $setores = null) {
        parent::__construct('funcionario');
        $this->setores = $setores;

        $this->setAttribute('method', 'post');
        #$this->setInputFilter(new CategoriaFilter);

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
                'id' => 'nome',
                'placeholder' => 'Entre com o nome'
            )
        ));
        
        
     

        $setor = new Select();
        $setor->setLabel("Setor")
                ->setName("setor")
                ->setOptions(array('value_options' => $this->setores)
        );
        $this->add($setor);

        $this->add(array(
            'name' => 'telefone',
            'options' => array(
                'type' => 'text',
                'label' => 'Telefone'
            ),
            'attributes' => array(
                'id' => 'telefone',
                'placeholder' => 'Entre com o Nº de Telefone'
            )
        ));


        $this->add(array(
            'name' => 'salario',
            'options' => array(
                'type' => 'text',
                'label' => 'Salario'
            ),
            'attributes' => array(
                'id' => 'salario',
                'placeholder' => 'Entre com o Salario'
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
