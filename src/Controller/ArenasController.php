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

    public function initialize() {
        parent::initialize();
        // $this->loadComponent('Upload');
        $this->loadComponent('Flash');
        $this->loadModel('Surroundings');
        
    }

    public function generateSurroundings() {
        $this->loadModel('Surroundings');
        // delete all existing surroundings

        if ($this->Surroundings->getAllSurroundings() != null) {
            $this->Surroundings->deleteAllSurroundings();
        }
        // set 15 colonnes
        for ($a = 0; $a < 15; $a++) {
            do {

                $pX = rand(0, 14);
                $pY = rand(0, 9);
            } while (($this->isSpotFree($pX, $pY) != 'true') || ($this->isSpotSurrounding($pX, $pY) != 'E'));

            $this->Surroundings->addNewSurrounding('P', $pX, $pY);
        }


        // set 15 pièges
        for ($b = 0; $b < 15; $b++) {
            do {

                $tX = rand(0, 14);
                $tY = rand(0, 9);
            } while (($this->isSpotFree($tX, $tY) != 'true') || ($this->isSpotSurrounding($tX, $tY) != 'E'));
            $this->Surroundings->addNewSurrounding('T', $tX, $tY);
        }
        // set 1 monstre
        do {
            $wX = rand(0, 14);
            $wY = rand(0, 9);
        } while (($this->isSpotFree($wX, $wY) != 'true') || ($this->isSpotSurrounding($wX, $wY) != 'E'));
        $this->Surroundings->addNewSurrounding('W', $wX, $wY);

        $this->redirect(['action' => 'sight']);
    }

    
    public function isSpotSurrounding($posX, $posY)
    {
        $this->loadModel('Surroundings');
        $decors = $this->Surroundings->getAllSurroundings()->toArray();
        
        if($decors)
        {
            
            foreach ($decors as $decor) 
            {
                if(($decor['coordinate_x'] == $posX) && ($decor['coordinate_y'] == $posY))
                {
                    return $decor['type'] ;
                }
            }
            return 'E';
        }
        else
        {
            return 'E';
        }
    }

    public function sight() {

        // get active fighter
        $playerId = $this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter = $this->Fighters->getFighterByPlayerId($playerId);
        $this->set('activeFighter', $activeFighter);
        // get all fighters
        $tabFighters = $this->Fighters->getAllAliveFighters();
        $this->set('tabFighters', $tabFighters);
        //get all decors
        $this->loadModel('Surroundings');
        $pillars = $this->Surroundings->getAllPillars();
        $this->set('pillars', $pillars);
        $traps = $this->Surroundings->getAllTraps();
        $this->set('traps', $traps);
        $monster = $this->Surroundings->getMonster();
        $this->set('monster', $monster);
        //get last event
        $this->loadModel('Events');
        $events = $this->Events->getAllEvents();
        $this->set('events', $events);
        //dd($monster->toArray());
    }

    public function moveFighter($direction, $fighterId) 
    {
        //get active fighter
        $this->loadModel("Fighters");
        $activeFighter = $this->Fighters->getFighterById($fighterId);
        //get event
        $this->loadModel('Events');
        $newPosX = $activeFighter['coordinate_x'];
        $newPosY = $activeFighter['coordinate_y'];

        if ($direction == 'l') {  //move left
            $newPosX--;
        }
        if ($direction == 'r') {  //move right
            $newPosX++;
        }
        if ($direction == 'u') {  //move up
            $newPosY--;
        }
        if ($direction == 'd') {  //move down
            $newPosY++;
        }

        if (($this->isSpotFree($newPosX, $newPosY) == 'false') || ($this->isSpotSurrounding($newPosX, $newPosY) == 'P')) {
            $this->Flash->error('You cannot move here!');
        } else {
            //if piège invisible T ou monstre W
            if (($this->isSpotSurrounding($newPosX, $newPosY) == 'T') || ($this->isSpotSurrounding($newPosX, $newPosY) == 'W')) {
                // activeFighter died
                $eventName = $activeFighter['name'] . ' died accidently';
                $this->Events->addNewEvent($eventName, $activeFighter['coordinate_x'], $activeFighter['coordinate_y']);

                $this->Fighters->setFighterHealth($activeFighter->id, 0);
            } else { // nothing -> Can move
                $this->Fighters->setPosition($fighterId, $newPosX, $newPosY);
            }
        }

        $this->redirect(['action' => 'sight']);
    }

    public function isSpotFree($newPosX, $newPosY) {
        $this->loadModel("Fighters");
        $fighters = $this->Fighters->getAllAliveFighters();

        //Check with other fighters
        foreach ($fighters as $fighter) {

            if (($fighter['coordinate_x'] == $newPosX) && ($fighter['coordinate_y'] == $newPosY)) {
                return('false');
            }
        }
        //Check grid borders
        if ($newPosX < 0 || $newPosX >= 15 || $newPosY < 0 || $newPosY >= 10) {
            return('false');
        }
        //ok to move
        return('true');
    }

    public function isNextToMonster($posX, $posY, $direction) {
        //getMonster
        $this->loadModel('Surroundings');
        $monster = $this->Surroundings->getMonster();
        switch ($direction) {
            case 'l':
                if (($monster->coordinate_x == $posX - 1) && ($monster->coordinate_y == $posY)) {
                    return true;
                }
                break;
            case 'r':
                if (($monster->coordinate_x == $posX + 1) && ($monster->coordinate_y == $posY)) {
                    return true;
                }
                break;
            case 'u':
                if (($monster->coordinate_x == $posX) && ($monster->coordinate_y == $posY - 1)) {
                    return true;
                }
                break;
            case 'd':
                if (($monster->coordinate_x == $posX) && ($monster->coordinate_y == $posY + 1)) {
                    return true;
                }
                break;
            default: return false;
        }
    }

    public function isNextToAdv($fighter, $tabFighters, $direction) {
        //Recuperate direction of attack
        //Check if Fighter position is next to another fighter from table
        //parcours table fighters
        switch ($direction) {
            case 'l':
                foreach ($tabFighters as $adv) {
                    if (($fighter['coordinate_x'] - 1 == $adv['coordinate_x']) &&
                            ($fighter['coordinate_y'] == $adv['coordinate_y']))
                        return $adv;
                }
                break;

            case 'r':
                foreach ($tabFighters as $adv) {
                    if (($fighter['coordinate_x'] + 1 == $adv['coordinate_x']) &&
                            ($fighter['coordinate_y'] == $adv['coordinate_y']))
                        return $adv;
                }
                break;

            case 'u':
                foreach ($tabFighters as $adv) {
                    if (($fighter['coordinate_x'] == $adv['coordinate_x']) &&
                            ($fighter['coordinate_y'] - 1 == $adv['coordinate_y']))
                        return $adv;
                }
                break;

            case 'd':

                foreach ($tabFighters as $adv) {
                    if (($fighter['coordinate_x'] == $adv['coordinate_x']) &&
                            ($fighter['coordinate_y'] + 1 == $adv['coordinate_y']))
                        return $adv;
                }
                break;

            default : return false;
        }
    }

    public function GuildMatesNumber($fighter, $tabFighters, $direction) {
        //Recuperate direction of attack
        //Check if Fighter position is next to another fighter from table
        //parcours table fighters
        $number = 0;
        
            
        switch ($direction) {
            case 'l':
                foreach ($tabFighters as $adv) {
                    if (($fighter['coordinate_x'] - 1 == $adv['coordinate_x'] + 1) &&
                            ($fighter['coordinate_y']  == $adv['coordinate_y']) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                        
                    }
                    if (($fighter['coordinate_x'] -1 == $adv['coordinate_x']) &&
                            ($fighter['coordinate_y']  == $adv['coordinate_y'] + 1) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                        
                    }
                    if (($fighter['coordinate_x'] -1 == $adv['coordinate_x'] ) &&
                            ($fighter['coordinate_y']  == $adv['coordinate_y'] -1) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                        
                    }
                }
                return $number;
                break;
            case 'r':
                foreach ($tabFighters as $adv) {
                    if (($fighter['coordinate_x']+ 1 == $adv['coordinate_x'] ) &&
                            ($fighter['coordinate_y']  == $adv['coordinate_y']+1) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                    }
                    if (($fighter['coordinate_x'] +1 == $adv['coordinate_x']) &&
                            ($fighter['coordinate_y'] == $adv['coordinate_y'] - 1) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                    }
                    if (($fighter['coordinate_x'] +1== $adv['coordinate_x'] - 1) &&
                            ($fighter['coordinate_y']  == $adv['coordinate_y']) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                    }
                }
                return $number;
                break;
            case 'u':
                foreach ($tabFighters as $adv) {
                    if (($fighter['coordinate_x']  == $adv['coordinate_x']) &&
                            ($fighter['coordinate_y']-1 == $adv['coordinate_y'] + 1) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                    }
                    if (($fighter['coordinate_x'] == $adv['coordinate_x'] + 1) &&
                            ($fighter['coordinate_y'] -1== $adv['coordinate_y']) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                    }
                    if (($fighter['coordinate_x']  == $adv['coordinate_x']-1) &&
                            ($fighter['coordinate_y'] -1== $adv['coordinate_y'] ) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                    }
                }
                return $number;
                break;
            case 'd':
                foreach ($tabFighters as $adv) {
                    if (($fighter['coordinate_x'] == $adv['coordinate_x']+1) &&
                            ($fighter['coordinate_y'] + 1 == $adv['coordinate_y']) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                    }
                    if (($fighter['coordinate_x'] == $adv['coordinate_x'] - 1) &&
                            ($fighter['coordinate_y'] + 1 == $adv['coordinate_y']) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                    }
                    if (($fighter['coordinate_x'] == $adv['coordinate_x']) &&
                            ($fighter['coordinate_y'] + 1 == $adv['coordinate_y'] - 1) &&
                            ($adv->guild_id == $fighter->guild_id)) {
                        $number = $number + 1;
                    }
                }
                return $number;
                break;
            default : return false;
        }
    }

    public function fight($direction, $fighterId) {
        //Recuperate player's fighter
        $this->loadModel("Fighters");
        $fighter = $this->Fighters->getFighterById($fighterId);

        //Recuperate fighters table
        $tabFighters = $this->Fighters->getAllAliveFighters();
        $this->set('tabFighters', $tabFighters);

        //load Event model
        $this->loadModel('Events');

        //load Surroundings
        $this->loadModel('Surroundings');

        //If next to adv
        if ($adv = $this->isNextToAdv($fighter, $tabFighters, $direction)) {

            //Calculate seuil = 10 + fighter level - adv level
            $seuil = 10 + $adv['level'] - $fighter['level'];
            $oldStrength = $fighter->skill_strength;
            //if attack succeeds
            if (rand(1, 20) > $seuil) {
                $number = $this->GuildMatesNumber($fighter, $tabFighters, $direction);
                $fighter->skill_strength = $oldStrength + $number;

                if ($number == 0) {

                    $this->Flash->success('Attack succeeded!');
                } else {

                    $this->Flash->success('Attack succeeded with the help of ' . $number . ' member(s) of your guild!');
                }
                //Decremente adv current health -1
                
                $this->Fighters->setFighterHealth($adv['id'], $adv['current_health'] - $fighter->skill_strength);

                //if adv dead
                if ($this->Fighters->getFighterHealth($adv['id']) <= 0) {
                    $this->Fighters->setFighterHealth($adv['id'], 0);
                    //GAGNE  : increment fighter's exp with his adv. exp points
                    $fighterXp = $fighter['xp'] + $adv['level'];
                    //Set nouvelle exp du player
                    $this->Fighters->setFighterXp($fighter['id'], $fighterXp);
                    $eventName = $fighter['name'] . ' attacks ' . $adv['name'] . ' and kills him';
                    $this->Events->addNewEvent($eventName, $fighter['coordinate_x'], $fighter['coordinate_y']);
                    $this->Flash->success("You have eliminated your enemy");
                } else {
                    //increment fighter xp +1
                    $this->Fighters->setFighterXp($fighter['id'], $fighter['xp'] + 1);
                    $eventName = $fighter['name'] . ' attacks ' . $adv['name'] . ' and touches him';
                    $this->Events->addNewEvent($eventName, $fighter['coordinate_x'], $fighter['coordinate_y']);
                }
            } else {
                $eventName = $fighter['name'] . ' attacks ' . $adv['name'] . ' and misses him';
                $this->Events->addNewEvent($eventName, $fighter['coordinate_x'], $fighter['coordinate_y']);
                $this->Flash->default("You missed your target.");
            }
        }
        // IF NEXT TO MONSTRE
        else {
            if ($this->isNextToMonster($fighter->coordinate_x, $fighter->coordinate_y, $direction)) {
                $this->Surroundings->deleteMonster();
                $eventName = $fighter['name'] . ' attacks the Arena monster and kills it';
                $this->Events->addNewEvent($eventName, $fighter['coordinate_x'], $fighter['coordinate_y']);
            }
        }
        $this->redirect(['action' => 'sight']);
    }

    public function diary() {
        // get active fighter
        $playerId = $this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter = $this->Fighters->getFighterByPlayerId($playerId);
        $this->set('activeFighter', $activeFighter);

        //get all events
        $this->loadModel('Events');
        $events = $this->Events->getAllEvents();
        $this->set('events', $events);
    }

    public function shout($fighterId) {
        //get active fighter
        $playerId = $this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter = $this->Fighters->getFighterByPlayerId($playerId);

        if ($this->request->is('post') && !empty($this->request->data)) {
            $this->loadModel('Events');
            $name=$activeFighter->name.' shouted: '.$this->request->data['name'];
            $this->Events->addNewEvent($name, $activeFighter->coordinate_x, $activeFighter->coordinate_y);
            $this->redirect(['action' => 'sight']);
        }
    }

    public function messages() {
        $playerId = $this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter = $this->Fighters->getFighterByPlayerId($playerId);
        $fighters = $this->Fighters->getAllFighters();
        $fightersNames = $this->Fighters->getFightersNames();
        $this->set('activeFighter', $activeFighter);
        $this->set('fighters', $fighters);
        $this->set('fightersNames', $fightersNames);
        $this->loadModel("Messages");
        $messages = $this->Messages->getMessagesByFighter($activeFighter->id)->toArray();
        $this->set('messages', $messages);
        //FORM
        if ($this->request->is('post') && !empty($this->request->data)) {
            $this->Messages->addNewMessage($this->request->data, $activeFighter->id);
            $this->redirect(['action' => 'messages']);
        }
    }

    public function chat($fighterId) {
        //get active fighter
        $playerId = $this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter = $this->Fighters->getFighterByPlayerId($playerId);
        $this->set('activeFighter', $activeFighter);
        //get chat fighter
        $chatFighter = $this->Fighters->getFighterById($fighterId);
        $this->set('chatFighter', $chatFighter);
        //get all fighters
        $fighters = $this->Fighters->getAllFighters();
        $this->set('fighters', $fighters);
        // get all messages for active fighter
        $this->loadModel("Messages");
        $messages = $this->Messages->getMessagesByFighter($activeFighter->id)->toArray();
        $this->set('messages', $messages);
        if ($this->request->is('post') && !empty($this->request->data)) {
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

      } */

    public function guild() {
        $playerId = $this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter = $this->Fighters->getFighterByPlayerId($playerId);
        $fighters = $this->Fighters->getAllAliveFighters();
        $this->set('fighters', $fighters);

        $this->loadModel("Guilds");
        $guilds = $this->Guilds->getGuilds();
        $this->set('guilds', $guilds);
        $fighterGuild = $this->Guilds->getFighterGuild($activeFighter->guild_id);
        $this->set('activeFighter', $activeFighter);
        $this->set('fighterGuild', $fighterGuild);          //Guild of active fighter
    }

    public function addGuild() {
        $playerId = $this->Auth->user('id');
        $this->loadModel("Fighters");
        $activeFighter = $this->Fighters->getFighterByPlayerId($playerId);

        $this->loadModel("Guilds");

        if ($this->request->is('post') && !empty($this->request->data)) {
            $newGuild = $this->Guilds->insertNewGuild($this->request->data);
            $this->Fighters->setFighterGuild($newGuild->id, $activeFighter->id);
            $this->Flash->success('Guild created successfully');
            $this->redirect(['action' => 'guild']);
        }
    }

    public function joinGuild($guildId) {
        $playerId = $this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");
        $activeFighter = $this->Fighters->getFighterByPlayerId($playerId);
        $this->Fighters->setFighterGuild($guildId, $activeFighter->id);
        $this->redirect(['action' => 'guild']);
    }

}
