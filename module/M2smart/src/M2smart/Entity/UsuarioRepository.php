<?php

namespace M2smart\Entity;

use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository {

   public function findByLoginAndSenha($login, $senha) {

        $usuario = $this->findOneByLogin($login);
        if ($usuario) {
            
            $hashSenha = $usuario->encryptSenha($senha);

            if ($hashSenha == $usuario->getSenha()) {
                return $usuario;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
