<?php

namespace M2smart\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="setores")
 * @ORM\Entity(repositoryClass="M2smart\Entity\SetorRepository")
 */
class Setor {
    
    public function __construct($options = null) {
        Configurator::configure($this,$options);
       $this->funcionarios = new ArrayCollection();
        
    }

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
     * @ORM\OneToMany(targetEntity="M2smart\Entity\Funcionario", mappedBy="setor")
     */ 
    protected $funcionarios;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function __toString() {
        return $this->nome;
    }
    
    public function getFuncionarios(){
        return $this->funcionarios;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome()
        );
    }

}
