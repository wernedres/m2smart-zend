<?php

namespace M2smart\Service;

use Doctrine\ORM\EntityManager;
use M2smart\Entity\Configurator;


//AbstractService 

class Setor  extends AbstractService{
     public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'M2smart\Entity\Setor';
        
    }
    
    
   
}
