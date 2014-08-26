<?php

namespace M2smart\Entity;

use Doctrine\ORM\EntityRepository;

class SetorRepository extends EntityRepository {

    public function fetchPairs() {  // aqui sao carregadas todas entidades cseterores e entities
        $entities = $this->findAll();
        $array = array();
        
        foreach ($entities as $entity) {
            $array[$entity->getId()] = $entity->getNome(); // <-aqui sera o valor de setores
        }

        return $array;
    }

}
