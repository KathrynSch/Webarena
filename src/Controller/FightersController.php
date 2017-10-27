<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Controller\App;

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
        $fighters = $this->paginate($this->Fighters);

        $this->set(compact('fighters'));
        $this->set('_serialize', ['fighters']);
    }

    public function view() {
        $playerId = $this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");   //load model de la table fighters
        $fighter = $this->Fighters->getFighterByPlayerId($playerId);



        if ($fighter->current_health == 0) {

            $this->redirect(['action' => 'deadfighter']);
        }
        if ($fighter == null) {

            $this->Flash->error("You have no fighter to display. Create a fighter please.");
            $this->redirect(['controller' => 'Fighters', 'action' => 'add']);
        } else {
            $this->loadModel("Guilds");
            $guild = $this->Guilds->getFighterGuild($fighter->guild_id);

            $this->set('guild', $guild);

            $this->set(compact('fighter'));
            $this->set('_serialize', ['fighter']);
            if (($fighter->xp) < 4) {
                $this->set("levelUpString", "You don't have enough XP to level up");
            } else {
                $oldFighterXp = $fighter->xp;
                $nbUpgrades = floor($oldFighterXp / 4);

                $levelUpString = "/!\ You can upgrade " . $nbUpgrades . " times!";
                $this->set("levelUpString", $levelUpString);
            }
        }
    }

    public function deadfighter() {
        $playerId = $this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");   //load model de la table fighters
        $fighter = $this->Fighters->getFighterByPlayerId($playerId);
        $this->loadModel("Guilds");
        $guild = $this->Guilds->getFighterGuild($fighter->id);
        $this->set('guild', $guild);

        $this->set(compact('fighter'));
        $this->set('_serialize', ['fighter']);
        $this->render('deadfighter');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $playerId = $this->Auth->user('id');
        $this->loadModel("Fighters");
        // if player has no fighter -> allow fighter creation
        $actualFighter = $this->Fighters->getFighterByPlayerId($playerId);

        if ($actualFighter != null && $actualFighter->current_health == 0) {
            $this->Fighters->deleteFighter($actualFighter->id); //delete dead fighter
        }
        if ($actualFighter == null || $actualFighter->current_health == 0) {  // if no fighter or old dead fighter -> allow new fighter
            $fighter = $this->Fighters->newEntity();
            if ($this->request->is('post') && !empty($this->request->data)) {
                $this->Fighters->addNewFighter($this->request->data, $playerId);
                $this->Flash->success(__('The fighter has been saved.'));

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
                    $this->Flash->success('Your picture upload is successfull!');
                    $this->redirect(['action' => 'view']);
                }
            } else {
                $this->Flash->error('There is a problem with your picture upload.');
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
                $this->Flash->success(__('The name has been saved.'));

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

                    $this->Flash->success('Your picture upload is successfull!');
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
        $fighter = $this->Fighters->get($id);
        if ($this->Fighters->delete($fighter)) {
            $this->Flash->success(__('The fighter has been deleted.'));
        } else {
            $this->Flash->error(__('The fighter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function levelup() {
        $playerId = $this->Auth->user('id');
        $this->loadModel("Fighters");
        $currentFighter = $this->Fighters->getFighterByPlayerId($playerId);
        $this->set("fighter", $currentFighter);

        $this->loadModel("Guilds");
        $guild = $this->Guilds->getFighterGuild($currentFighter->guild_id);
        $this->set('guild', $guild);

        $fighterId = $currentFighter->id;
        $oldFighterXp = $currentFighter->xp;
        $oldFighterLevel = $currentFighter->level;

        if (($currentFighter->xp) < 4) {
            $this->Flash->error("You don't have enough XP to level up");
            $this->redirect(['action' => 'view']);
        } else {

            if ($this->request->is('post') && !empty($this->request->data)) {
                if (($this->request->data['upgrade']) == 0) {
                    $oldSight = $currentFighter->skill_sight;

                    $newSight = $oldSight + 1;
                    $this->Fighters->setFighterSight($fighterId, $newSight);


                    $newFighterXp = $oldFighterXp - 4;
                    $newFighterLevel = $oldFighterLevel + 1;
                    $this->Fighters->setFighterXp($fighterId, $newFighterXp);
                    $this->Fighters->setFighterLevel($fighterId, $newFighterLevel);


                    $this->Flash->success("You won a level and upgraded your sight!");
                    $this->redirect(['action' => 'view']);
                }
                if (($this->request->data['upgrade']) == 1) {
                    $oldForce = $currentFighter->skill_strength;

                    $newForce = $oldForce + 1;
                    $this->Fighters->setFighterForce($fighterId, $newForce);

                    $newFighterXp = $oldFighterXp - 4;
                    $newFighterLevel = $oldFighterLevel + 1;
                    $this->Fighters->setFighterXp($fighterId, $newFighterXp);
                    $this->Fighters->setFighterLevel($fighterId, $newFighterLevel);

                    $this->Flash->success("You won a level and upgraded your strenght!");
                    $this->redirect(['action' => 'view']);
                }
                if (($this->request->data['upgrade']) == 2) {
                    $oldMaxLife = $currentFighter->skill_health;
                    $oldCurrentLife = $currentFighter->current_health;

                    $newMaxLife = $oldMaxLife + 3;
                    $newCurrentLife = $newMaxLife;

                    $this->Fighters->setFighterHealth($fighterId, $newCurrentLife);
                    $this->Fighters->setFighterMaximumHealth($fighterId, $newMaxLife);

                    $newFighterXp = $oldFighterXp - 4;
                    $newFighterLevel = $oldFighterLevel + 1;
                    $this->Fighters->setFighterXp($fighterId, $newFighterXp);
                    $this->Fighters->setFighterLevel($fighterId, $newFighterLevel);

                    $this->Flash->success("You won a level and upgraded your life!");
                    $this->redirect(['action' => 'view']);
                }
            }
        }
    }

}
