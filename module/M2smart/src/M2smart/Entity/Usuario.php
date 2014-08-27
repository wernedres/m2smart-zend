<?php

namespace M2smart\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="M2smart\Entity\UsuarioRepository")
 */
class Usuario {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var  int
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $login;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $senha;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $salt;

    public function __construct($options = null) {
        Configurator::configure($this, $options);
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
        return $this;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $hashSenha = hash('sha512', $senha.$this->salt);
        for ($i = 0; $i < 64000; $i++)
            $hashSenha = hash('sha512', $hashSenha);

        $this->senha = $hashSenha;
        return $this;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

//    public function encryptPassword($senha) {
//        $hashSenha = hash('sha512', $senha . $salt);
//        for ($i = 0; $i < 64000; $i++)
//            $hashSenha = hash('sha512', $hashSenha);
//
//        return $hashSenha;
//    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'login' => $this->getLogin(),
            'senha' => $this->getSenha(),
            'salt' => $this->salt
        );
    }

}
