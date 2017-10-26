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
<<<<<<< HEAD
        if ($fighter == null) {
=======
        if($fighter->current_health == 0){
            
            $this->redirect(['action' =>'deadfighter']);
        }
        if ($fighter == null){
>>>>>>> f85709c452e7333e58448191b32a01928ebeb36f
            $this->Flash->error("You have no fighter to display. Create a fighter please.");
            $this->redirect(['controller' => 'Fighters', 'action' => 'add']);
        } else {
            $this->loadModel("Guilds");
            $guild = $this->Guilds->getFighterGuild($fighter->id);
            $this->set('guild', $guild);

            $this->set(compact('fighter'));
            $this->set('_serialize', ['fighter']);
        }
    }

<<<<<<< HEAD
    public function add() {
        $playerId = $this->Auth->user('id');
        $this->loadModel("Fighters");
        if (($this->Fighters->getFighterByPlayerId($playerId)) == null) {
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






                //move_uploaded_file($file_tmp_name,$dir.DS.$newName);
                /* if ($filedb->save($entity)) {
                  $flash->success(__('The fighter has been saved.'));

                  }
                  else{
                  $flash->error(__('The fighter could not be saved. Please, try again.'));

                  } */
                if (move_uploaded_file($file_tmp_name, $dir . DS . $newName) && is_writable($dir)) {

                    $this->Flash->success('Your picture upload is successfull!');
                    $this->redirect(['action' => 'view']);
                } else {

                    $this->Flash->error('There is a problem with your picture upload.');
                }
            }
        } else {
=======

    public function deadfighter()
    {
        $playerId=$this->Auth->user('id');          //Player logged in
        $this->loadModel("Fighters");   //load model de la table fighters
        $fighter = $this->Fighters->getFighterByPlayerId($playerId);
        $this->loadModel("Guilds");
        $guild=$this->Guilds->getFighterGuild($fighter->id);
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

    public function add()
    {
        $playerId=$this->Auth->user('id');
        $this->loadModel("Fighters");
        // if player has no fighter -> allow fighter creation
        $actualFighter = $this->Fighters->getFighterByPlayerId($playerId);

        if( $actualFighter != null && $actualFighter->current_health == 0)
            {
                $this->Fighters->deleteFighter($actualFighter->id); //delete dead fighter
            }
        if( $actualFighter == null || $actualFighter->current_health == 0)  // if no fighter or old dead fighter -> allow new fighter
        {
            $fighter = $this->Fighters->newEntity();
            if ($this->request->is('post') && !empty($this->request->data))
            {
                $this->Fighters->addNewFighter($this->request->data,$playerId);
                $this->Flash->success(__('The fighter has been saved.'));
                 
                $filename=$this->Fighters->getFighterByPlayerId($playerId)->id;
                 
                $file_tmp_name=$this->request->data['avatar_file']['tmp_name'];
                $dir= WWW_ROOT . 'img'.DS.'avatars' ;
                $allowed=array('png','jpg','jpeg','gif');

                $avatarExtension=strtolower(substr(strrchr($this->request->data['avatar_file']['name'],'.'),1));
                    
                if(!in_array($avatarExtension,$allowed))
                {
                    dd("There is a problem with your file, please choose another.");
                }
                $newName=$filename.'.png';
                if(move_uploaded_file($file_tmp_name,$dir.DS.$newName)&& is_writable($dir))
                {
                    $this->Flash->success('Your picture upload is successfull!'); 
                    $this->redirect(['action' => 'view']);
                }
            }
            else
            { 
                $this->Flash->error('There is a problem with your picture upload.');          
            }
        }        
        else
        {   //if fighter is dead
            if($actualFighter->current_health == 0)
>>>>>>> f85709c452e7333e58448191b32a01928ebeb36f
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

    public function upload($playerId) {
        if (!empty($this->request->data)) {
            //debug($this->request->data); die();
            $this->Upload->send($this->request->data, $this->Flash, $playerId);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $fighter = $this->Fighters->get($id);
        if ($this->Fighters->delete($fighter)) {
            $this->Flash->success(__('The fighter has been deleted.'));
        } else {
            $this->Flash->error(__('The fighter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
