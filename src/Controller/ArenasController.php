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
    
    
    
    
    public function index(){
        
       
    }
    
    public function sight() {
        $playerId=$this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterByPlayerId($playerId);
        $this->set('activeFighter', $activeFighter);
        $tabFighters=$this->Fighters->getAllFighters();
        $this->set('tabFighters', $tabFighters);
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

        $this->Fighters->setPosition($fighterId, $newPosX, $newPosY);
        $this->redirect(['action' => 'sight']);
    }

    public function isNextToAdv($fighter, $tabFighters, $direction)
    {
        //Recuperate direction of attack

         //Check if Fighter position is next to another fighter from table
        //parcours table fighters
        switch($direction)
        {
            case 'l':
                 foreach($tabFighters as $adv)
                    {
                        if(($fighter['coordinate_y']== $adv['coordinate_y']) && 
                            ($fighter['coordinate_x']-1 == $adv['coordinate_x']))
                            return $adv;
                    }
                    break;
            
            case 'r':
                 foreach($tabFighters as $adv)
                    {
                        if(($fighter['coordinate_y']== $adv['coordinate_y']) && 
                            ($fighter['coordinate_x']+1 == $adv['coordinate_x']))
                            return $adv;
                    } 
                    break;

            case 'u':
                 foreach($tabFighters as $adv)
                    {
                        if(($fighter['coordinate_x']== $adv['coordinate_x']) && 
                            ($fighter['coordinate_y']-1 == $adv['coordinate_y']))
                            return $adv;
                    }
                    break;

            case 'd':
                 foreach($tabFighters as $adv)
                    {
                        if(($fighter['coordinate_x']== $adv['coordinate_x']) && 
                            ($fighter['coordinate_y']+1 == $adv['coordinate_y']))
                            return $adv;
                    }
                    break;

            default : return false;



        }

    }

    public function fight($direction, $fighterId)
    {
        //Recuperate player's fighter
        $this->loadModel("Fighters");
        $fighter=$this->Fighters->getFighterById($fighterId);

        //Recuperate fighters table
        $tabFighters=$this->Fighters->getAllFighters();
        $this->set('tabFighters', $tabFighters);

        //If next to adv
        if($adv = $this->isNextToAdv($fighter, $tabFighters, $direction))
        {
            //Calculate seuil = 10 + fighter level - adv level
            $seuil= 10 + $fighter['level'] - $adv['level'];

            //if attack succeeds
            if (rand(1,20) > $seuil)
            {
                $this->Flash->success('Attack succeeded!');
                //Decremente adv current health -1
                 $this->Fighters->setFighterHealth($adv['id'],$adv['current_health']-1);

                //Check if adv dead
                if($this->Fighters->getFighterHealth($adv['id']) == 0)
                {
                //GAGNE  : increment fighter's exp with his adv. exp points
                $fighterXp=$fighter['xp']+$adv['xp'];
                //Set nouvelle exp du player
                $this->Fighters->setFighterXp($fighter['id'], $fighterXp);
                }

                else
                {
                    //increment fighter xp +1
                    $this->Fighters->setFighterXp($fighter['id'], $fighter['xp']+1);
                }   
            }
            else{
                dd('rate!');
            }
        }
    $this->redirect(['action'=> 'sight'] );        
    }



    public function diary($fighterId) 
    {
        
    }

    public function messages($fighterId)
    {
        
    }

    public function guild($fighterId)
    {

    }

    public function shout($fighterId)
    {

    }
}
