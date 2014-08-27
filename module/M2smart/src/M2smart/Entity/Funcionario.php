<?php

namespace M2smart\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="funcionarios")
 * @ORM\Entity(repositoryClass="M2smart\Entity\FuncionarioRepository")
 */
class Funcionario {
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;

    /**
     * @ORM\ManyToOne(targetEntity="M2smart\Entity\Setor", inversedBy="funcionario")
     * @ORM\JoinColumn(name="setor_id", referencedColumnName="id")
     * @var int
     */
    protected $setor;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $telefone;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $salario;

 

    public function __construct($options=null) {
        Configurator::configure($this, $options);
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

    public function getSetor() {
        return $this->setor;
    }

    public function setSetor($setor) {
        $this->setor = $setor;
        return $this;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
        return $this;
    }

    public function getSalario() {
        return $this->salario;
    }

    public function setSalario($salario) {
        $this->salario = $salario;
        return $this;
    }



    public function toArray() {
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'telefone' => $this->getTelefone(),
            'salario' => $this->getSalario(),
            'setor' => $this->getSetor()
        );
    }

}
