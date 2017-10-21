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

    public function login() {
        
    }

    public function fighter($id) {
        $this->loadModel("Fighters");   //load model de la table fighters
        $fighter = $this->Fighters->getPlayerFighter($id)->toArray();
        $this->set('fighter', $fighter);
        $this->render();
       //get user's fighter    
    
    }
    public function addFighterPicture($fighterId)
    {
        $this->loadModel("Fighters");
        $picture = $this->request->file('picture');
        $this->Fighters->getPlayerFighter($fighterId, $picture);
    }

    public function sight() {
        $this->loadModel("Fighters");
        $best = $this->Fighters->getBestFighter()->toArray();
        //$best=$this->Fighters->find('all')->first(['id' => 'DESC']);
        //->order(['id' => 'ASC'])
        //->order()->first
        //pr($best->toArray());
        //$best=($best->toArray());
        $this->set('best', $best);
    }

    public function diary() {
        
    }

}
