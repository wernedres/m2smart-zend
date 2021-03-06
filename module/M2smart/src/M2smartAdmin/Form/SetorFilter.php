<?php

namespace M2smartAdmin\Form;

use Zend\InputFilter\InputFilter;

class SetorFilter  extends InputFilter{
    
    public function __construct() {

    $this->add(array(
     'name' => 'nome',
      'required' => true,
      'filters' =>  array(
        array('name'=>'StripTags'),
        array('name'=>'StringTrim')
    ),
    'validators' => array(
        array(
            'name' => 'NotEmpty',
            'options'=>array(
                'messages' => array('isEmpty'=>'Nome nao pode esta em branco'),
            )
        )
    )
));
    
  }
}