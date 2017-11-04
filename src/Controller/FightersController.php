<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Controller\App;
use App\Controller\ArenasController;

/**
 * Fighters Controller
 *
 * @property \App\Model\Table\FightersTable $Fighters
 *
 * @method \App\Model\Entity\Fighter[] paginate($object = null, array $settings = [])
 */
class FightersController extends AppController {

    public function initialize() {
        parent::initialize();
        // $this->loadComponent('Upload');
        $this->loadComponent('Flash');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->loadModel('Fighters');
        $fighters = $this->Fighters->getFightersLeveled();
        $this->set('fighters', $fighters);

        $this->loadModel('Guilds');
        $guilds = $this->Guilds->getGuilds();
        $this->set('guilds', $guilds);
    }

    public function view() {
        //get active fighter
        $playerId = $this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");   //load model de la table fighters
        $fighter = $this->Fighters->getFighterByPlayerId($playerId);
        //if no fighter
        if ($fighter == null) {
            
            $this->redirect(['controller' => 'Fighters', 'action' => 'add']);
        } else {
            //get guilds
            $this->loadModel("Guilds");
            $guild = $this->Guilds->getFighterGuild($fighter->guild_id);
            $this->set('guild', $guild);
            //set fighter
            $this->set(compact('fighter'));
            $this->set('_serialize', ['fighter']);
            if (($fighter->xp) < 4) {
                $isUpgradable = false;
                $this->set('isUpgradable', $isUpgradable);
            } else {
                $oldFighterXp = $fighter->xp;
                $nbUpgrades = floor($oldFighterXp / 4);
                $levelUpString = "You can upgrade your level (" . $nbUpgrades . ") !";
                $this->set("levelUpString", $levelUpString);
                $isUpgradable = true;
                $this->set('isUpgradable', $isUpgradable);
            }
        }
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {

        $playerId = $this->Auth->user('id');
        $this->loadModel("Fighters");
        $Arenas = new ArenasController;
        // if player has no fighter -> allow fighter creation
        $actualFighter = $this->Fighters->getFighterByPlayerId($playerId);

        //if actual fighter dead delete it 
        if ($actualFighter != null && $actualFighter->current_health == 0) {

            $this->Fighters->deleteFighter($actualFighter->id); //delete dead fighter
        }
        if ($actualFighter == null || $actualFighter->current_health == 0) {  // if no fighter or old dead fighter -> allow new fighter
            $fighter = $this->Fighters->newEntity();
            if ($this->request->is('post') && !empty($this->request->data)) {


                $tabfighters = $this->Fighters->getAllFighters();
                do {
                    $occupy = false;
                    $x = rand(0, 14);
                    $y = rand(0, 9);

                    foreach ($tabfighters as $fighter) {

                        if ($fighter['coordinate_x'] == $x && $fighter['coordinate_y'] == $y) {

                            $occupy = true;
                        }
                    }
                } while (($occupy) || ($Arenas->isSpotFree($x, $y) != 'true') || ($Arenas->isSpotSurrounding($x, $y) != 'E'));

                $this->Fighters->addNewFighter($this->request->data, $playerId, $x, $y);
                $this->Flash->success(__('The fighter has been saved.'));
                //get new fighter
                $fighter = $this->Fighters->getFighterByPlayerId($playerId);
                //load Events model
                $this->loadModel('Events');
                $eventName = $fighter['name'] . ' entered the Arena';
                $this->Events->addNewEvent($eventName, $fighter['coordinate_x'], $fighter['coordinate_y']);

                $filename = $fighter->id;

                $file_tmp_name = $this->request->data['avatar_file']['tmp_name'];
                $dir = WWW_ROOT . 'img' . DS . 'avatars';
                $allowed = array('png', 'jpg', 'jpeg', 'gif');

                $avatarExtension = strtolower(substr(strrchr($this->request->data['avatar_file']['name'], '.'), 1));

                if (!in_array($avatarExtension, $allowed)) {
                    $this->Flash->error("There is a problem with your file, please choose another.");
                }
                $newName = $filename . '.png';
                if (move_uploaded_file($file_tmp_name, $dir . DS . $newName) && is_writable($dir)) {
                    $this->Flash->success('Your picture upload is successfull!');
                    $this->redirect(['action' => 'view']);
                }
            } else {
                //$this->Flash->error('There is a problem with your picture upload.');
            }
        } else {   //if fighter is dead (condition unecessary)
            //if($actualFighter->current_health == 0)
            $this->Flash->error('You can\'t have more than one fighter.');
            $this->redirect(['action' => 'view']);
        }
    }

    /**
     * Edit method
     * F
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit() {
        $playerId = $this->Auth->user('id');

        $this->loadModel("Fighters");
        if (($this->Fighters->getFighterByPlayerId($playerId)) <> null) {
            $fighter = $this->Fighters->newEntity();
            if ($this->request->is('post') && !empty($this->request->data)) {

                $fighterId = $this->Fighters->getFighterByPlayerId($playerId)->id;
                $this->Fighters->setFighterName($fighterId, $this->request->data['name']);
                //$this->Flash->success(__('The name has been saved.'));

                $filename = $this->Fighters->getFighterByPlayerId($playerId)->id;

                $file_tmp_name = $this->request->data['avatar_file']['tmp_name'];
                $dir = WWW_ROOT . 'img' . DS . 'avatars';
                $allowed = array('png', 'jpg', 'jpeg', 'gif');

                $avatarExtension = strtolower(substr(strrchr($this->request->data['avatar_file']['name'], '.'), 1));

                if (!in_array($avatarExtension, $allowed)) {
                    dd("There is a problem with your file, please choose another.");
                }
                $newName = $filename . '.png';

                if (move_uploaded_file($file_tmp_name, $dir . DS . $newName) && is_writable($dir)) {

                    //$this->Flash->success('Your picture upload is successfull!');
                    $this->redirect(['action' => 'view']);
                } else {

                    $this->Flash->error('There is a problem with your picture upload.');
                }
            }
        } else {
            $this->Flash->error('You have no fighter to edit.');
            $this->redirect(['action' => 'view']);
        }
    }

    /* public function upload($playerId) {
      if (!empty($this->request->data)) {
      //debug($this->request->data); die();
      $this->Upload->send($this->request->data, $this->Flash, $playerId);
      }
      } */

    /**
     * Delete method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete() {

        $id = $this->Auth->user('id');
        $this->request->allowMethod(['post', 'delete']);
        $fighter = $this->Fighters->getFighterByPlayerId($id);
        if ($this->Fighters->delete($fighter)) {
            $this->Flash->success(__('The fighter has been deleted.'));
        } else {
            $this->Flash->error(__('The fighter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function levelup($upgrade) {
        //get active fighter
        $playerId = $this->Auth->user('id');
        $this->loadModel("Fighters");
        $currentFighter = $this->Fighters->getFighterByPlayerId($playerId);
        //write event
        $this->loadModel('Events');
        $eventName = $currentFighter['name'] . ' upgraded level to ' . ($currentFighter->level + 1);
        $this->Events->addNewEvent($eventName, $currentFighter->coordinate_x, $currentFighter->coordinate_y);
        //set new level
        $this->Fighters->setFighterLevel($currentFighter->id, $currentFighter->level + 1);
        //set new XP
        $this->Fighters->setFighterXp($currentFighter->id, $currentFighter->xp - 4);
        //set new skill
        switch ($upgrade) {
            case 'sight':
                $this->Fighters->setFighterSight($currentFighter->id, $currentFighter->skill_sight + 1);
                break;
            case 'strength':
                $this->Fighters->setFighterStrength($currentFighter->id, $currentFighter->skill_strength + 1);
                break;
            case 'health':
                $this->Fighters->setFighterHealth($currentFighter->id, $currentFighter->skill_health + 3);
                $this->Fighters->setFighterSkillHealth($currentFighter->id, $currentFighter->skill_health + 3);
                break;
        }
        $this->redirect(['action' => 'view']);
    }

}
