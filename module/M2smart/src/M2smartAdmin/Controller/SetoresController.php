<?php

namespace M2smartAdmin\Controller;



class SetoresController extends CrudController {

   public function __construct() {

        $this->entity = "M2smart\Entity\Setor";
        $this->form = "M2smartAdmin\Form\Setor";
        $this->service = "M2smart\Service\Setor";
        $this->controller = "setores";
        $this->route = "m2smart-admin";
    }


}
