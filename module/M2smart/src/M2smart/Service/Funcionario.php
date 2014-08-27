<?php

namespace M2smart\Service;

use Doctrine\ORM\EntityManager;
use M2smart\Entity\Configurator;

class Funcionario extends AbstractService {

    public function __construct(EntityManager $em) {
        parent::__construct($em);
        $this->entity = 'M2smart\Entity\Funcionario';
    }

    public function insert(array $data) {
        $entity = new $this->entity($data);

        $setor = $this->em->getReference("M2smart\Entity\Setor", $data['setor']); //getReference não faz consulta no banco de dados
        $entity->setSetor($setor);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->entity, $data['id']);
        $entity = Configurator::configure($entity,$data); //com configurator nos estamos pegando e passando os gets and sets

        $setor = $this->em->getReference("M2smart\Entity\Setor", $data['setor']); //getReference não faz consulta no banco de dados
        $entity->setSetor($setor);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

}
  