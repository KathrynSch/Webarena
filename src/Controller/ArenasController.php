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
    
    public function sight() {
        $playerId=$this->Auth->user('id');          //Player logged in

        $this->loadModel("Fighters");
        $fighter=$this->Fighters->getFighterByPlayerId($playerId);
        $this->set('fighterId', $fighter['id']);
        $this->set('fighterPosX', $fighter['coordinate_x']);
        $this->set('fighterPosY', $fighter['coordinate_y']);
        $tabFighters=$this->Fighters->getAllFighters();
        //$nbFighters=$this->Fighters->getNbFighters($tabFighters);

        $this->set('tabFighters', $tabFighters);
       // $this->set('nbFighters', $nbFighters);

    }

    public function moveFighter($direction, $fighterId)
    {
        $this->loadModel("Fighters");
        $fighter=$this->Fighters->getFighterById($fighterId);
        $newPosX= $fighter['coordinate_x'];
        $newPosY= $fighter['coordinate_y'];

        if($direction == 'l'){  //move left
           $newPosX-- ;
        }
        if($direction == 'r'){  //move right
            $newPosX++ ;
        }
        if($direction == 'u'){  //move up
            $newPosY-- ;
        }
        if($direction == 'd'){  //move down
            $newPosY++ ;
        }

        $this->Fighters->updatePosition($fighterId, $newPosX, $newPosY);
        $this->redirect(['action' => 'sight']);
    }
    public function diary() {
        
    }

}
