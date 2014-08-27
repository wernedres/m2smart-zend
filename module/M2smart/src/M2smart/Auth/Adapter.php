<?php

namespace M2smart\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;
use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface {

    /**
     * @var EntityManager
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
        return $this;
    }

    public function authenticate() {

        $repository = $this->em->getRepository("M2smart\Entity\Usuario");
        $usuario = $repository->findByLoginAndSenha($this->getUsername(),$this->getSenha());

        if ($usuario) {
            return new Result(Result::SUCCESS, array('usuario'=>$usuario), array('ok'));
        } else {
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());
        }
    }

}
