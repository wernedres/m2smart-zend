<?php

namespace M2smartAdmin\Form;

use Zend\Form\Form;    


class Setor extends Form {
     public function __construct($name = null) {
        parent::__construct('setor');
        
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new SetorFilter);
        
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
    $this->add(array(
        'name' => 'submit',
         'type' => 'Zend\Form\Element\Submit',
         'attributes' => array(
            'value'  => 'Salvar',
            'class'  => 'btn-success'
        )
   ) );
    
  }

}