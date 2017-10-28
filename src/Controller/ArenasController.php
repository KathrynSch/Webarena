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
        $activeFighter=$this->Fighters->getFighterByPlayerId($playerId);
        $this->set('activeFighter', $activeFighter);
        $tabFighters=$this->Fighters->getAllAliveFighters();
        $this->set('tabFighters', $tabFighters);
    }

    public function moveFighter($direction, $fighterId)
    {
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterById($fighterId);
        $newPosX= $activeFighter['coordinate_x'];
        $newPosY= $activeFighter['coordinate_y'];

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
        
         if($this->isOkToMove($fighterId, $newPosX, $newPosY) == 'false'){
             $this->Flash->error('You cannot move here!');
          
         }
         
         else{
            $this->Fighters->setPosition($fighterId, $newPosX, $newPosY);
             
         }
         
         $this->redirect(['action' => 'sight']);
    }
    
    public function isOkToMove($fighterId, $newPosX,$newPosY){
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterById($fighterId);
        $fighters=$this->Fighters->getAllAliveFighters();
        
        //Check with other fighters
        foreach($fighters as $fighter){

            if(($fighter['coordinate_x'] == $newPosX) && ($fighter['coordinate_y']== $newPosY)){
                return('false');
            }  
        }
        
        //Check grid borders
        if($newPosX < 0 || $newPosX >=15 || $newPosY<0 || $newPosY>=10){
                return('false');
        }
        
        
        //ok to move
        return('true');

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
        $tabFighters=$this->Fighters->getAllAliveFighters();
        $this->set('tabFighters', $tabFighters);

        //load Event model
        $this->loadModel('Events');

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

                //if adv dead
                if($this->Fighters->getFighterHealth($adv['id']) == 0)
                {
                    //GAGNE  : increment fighter's exp with his adv. exp points
                    $fighterXp=$fighter['xp']+$adv['level'];
                    //Set nouvelle exp du player
                    $this->Fighters->setFighterXp($fighter['id'], $fighterXp);
                    $eventName = $fighter['name'].' attacks '.$adv['name'].' and kills him';
                    $this->Events->addNewEvent($eventName, $fighter['coordinate_x'], $fighter['coordinate_y']);
                }
                else
                {
                    //increment fighter xp +1
                    $this->Fighters->setFighterXp($fighter['id'], $fighter['xp']+1);
                    $eventName = $fighter['name'].' attacks '.$adv['name'].' and touches him';
                    $this->Events->addNewEvent($eventName, $fighter['coordinate_x'], $fighter['coordinate_y']);
                }   
            }
            else{
                $eventName = $fighter['name'].' attacks '.$adv['name'].' and misses him';
                $this->Events->addNewEvent($eventName, $fighter['coordinate_x'], $fighter['coordinate_y']);
            }
        }
    $this->redirect(['action'=> 'sight'] );        
    }

    public function diary() 
    {   
        // get active fighter
        $playerId=$this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterByPlayerId($playerId);

        //get all events
        $this->loadModel('Events');
        $events=$this->Events->getAllEvents();
        $this->set('events', $events);
    }

    public function shout($fighterId)
    {
        //get active fighter
        $playerId=$this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterByPlayerId($playerId);

        if ($this->request->is('post') && !empty($this->request->data))
        {
            $this->loadModel('Events');
            $this->Events->addNewEvent($this->request->data['name'], $activeFighter->coordinate_x, $activeFighter->coordinate_y);
            $this->redirect(['action' => 'sight']);
        }
    }

    public function messages()
    {
        $playerId=$this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterByPlayerId($playerId);
        $fighters = $this->Fighters->getAllFighters();
        $fightersNames = $this->Fighters->getFightersNames();
        $this->set('activeFighter', $activeFighter);
        $this->set('fighters', $fighters);
        $this->set('fightersNames', $fightersNames);
        $this->loadModel("Messages");
        $messages= $this->Messages->getMessagesByFighter($activeFighter->id)->toArray();
        $this->set('messages', $messages);
        //FORM
        if ($this->request->is('post') && !empty($this->request->data))
        {
            $this->Messages->addNewMessage($this->request->data, $activeFighter->id);
            $this->redirect(['action' => 'messages']);
        }
    }
    public function chat($fighterId)
    {
        //get active fighter
        $playerId=$this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterByPlayerId($playerId);
        $this->set('activeFighter', $activeFighter);
        //get chat fighter
        $chatFighter=$this->Fighters->getFighterById($fighterId);
        $this->set('chatFighter', $chatFighter);
        //get all fighters
        $fighters = $this->Fighters->getAllFighters();
        $this->set('fighters', $fighters);
        // get all messages for active fighter
        $this->loadModel("Messages");
        $messages= $this->Messages->getMessagesByFighter($activeFighter->id)->toArray();
        $this->set('messages', $messages);
        if ($this->request->is('post') && !empty($this->request->data))
        {
            $this->Messages->addNewChatMessage($this->request->data, $activeFighter->id, $fighterId);
            $this->redirect(['action' => 'chat', $fighterId]);
        }
    }
/*
    public function sendmessage()
    {
        $playerId=$this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterByPlayerId($playerId);
        
    }*/

    public function guild()
    {
        $playerId=$this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterByPlayerId($playerId);
        $fighters=$this->Fighters->getAllAliveFighters();
        $this->set('fighters', $fighters);

        $this->loadModel("Guilds");
        $guilds = $this->Guilds->getGuilds();
        $this->set('guilds', $guilds);
        $fighterGuild = $this->Guilds->getFighterGuild($activeFighter->guild_id);
        $this->set('activeFighter', $activeFighter);
        $this->set('fighterGuild', $fighterGuild);          //Guild of active fighter
    }

    public function addGuild()
    {
        $playerId=$this->Auth->user('id');
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterByPlayerId($playerId);

        $this->loadModel("Guilds");
        
        if ($this->request->is('post') && !empty($this->request->data)) {
            $newGuild = $this->Guilds->insertNewGuild($this->request->data);
            $this->Fighters->setFighterGuild($newGuild->id, $activeFighter->id);
            $this->Flash->success('Guild created successfully');
            $this->redirect(['action' => 'guild']);
        }
    }

    public function joinGuild($guildId)
    {
        $playerId=$this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter=$this->Fighters->getFighterByPlayerId($playerId);
        $this->Fighters->setFighterGuild($guildId, $activeFighter->id);
        $this->redirect(['action' => 'guild']);
    }


}
