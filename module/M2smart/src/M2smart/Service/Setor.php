<?php

namespace M2smart\Service;

use Doctrine\ORM\EntityManager;
use M2smart\Entity\Setor as SetorService;
use M2smart\Entity\Configurator;


//AbstractService 

class Setor {
    
    /**
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em) {
//  parent::__construct($em);
        $this->em = $em;           
    }
    public  function insert(array $data){
        $entity = new SetorService($data);
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
    public  function update(array $data){
        $entity = $this->em->getReference('M2smart\Entity\Setor', $data['id']);
        $entity = Configurator::configure($entity, $data);
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
    
    public function  delete($id){
         $entity = $this->em->getReference('M2smart\Entity\Setor', $id);
         if($entity){
             $this->em->remove($entity);
             $this->em->flush();
             return $id;
         }
        
        
        
    }
    
}
