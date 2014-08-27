<?php 

namespace M2smart\Service;

use Doctrine\ORM\EntityManager;
use M2smart\Entity\Configurator;

class Usuario extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'M2smart\Entity\Usuario';
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->entity, $data['id']);
        if (empty($data['senha']))
            unset($data['senha']);
        
        $entity = Configurator::configure($entity, $data);//se o dado da senha for em branco o configurator nao vai rolar, pq to dando unsset
        
        $this->em->persist($entity);
        $this->em->flush();
        
        return $entity;
        
        
        }

}
