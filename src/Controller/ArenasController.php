<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArenasController
 *
 * @author jauff
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Personal Controller
 * User personal interface
 *
 */
class ArenasController extends AppController {

    public function index() {
        /*         * $this->set('myname',"Julien Falconnet");
          $this->loadModel('Fighters');
          $figterlist=$this->Fighters->find('all');
          pr($figterlist->toArray()); */
    }



    public function fighter($id) {
        $this->loadModel("Fighters");   //load model de la table fighters
        $fighter = $this->Fighters->getPlayerFighter($id)->toArray();
        $this->set('fighter', $fighter);
        $this->render();

       //get user's fighter    
    }

    
    public function sight() {
        
    }

    public function diary() {
        
    }

}
