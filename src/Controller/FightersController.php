<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Fighters Controller
 *
 * @property \App\Model\Table\FightersTable $Fighters
 *
 * @method \App\Model\Entity\Fighter[] paginate($object = null, array $settings = [])
 */
class FightersController extends AppController
{
    
    
    public function initialize(){
        parent::initialize();
        $this->loadComponent('Upload');
        $this->loadComponent('Flash');

    }
    
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $fighters = $this->paginate($this->Fighters);

        $this->set(compact('fighters'));
        $this->set('_serialize', ['fighters']);
    }
    public function view($playerId)
    {
        $this->loadModel("Fighters");   //load model de la table fighters
        $fighter = $this->Fighters->getFighterByPlayerId($playerId);
        if ($fighter == null){
            $this->add($playerId);
            
        }
        else{
        $this->set(compact('fighter'));
        $this->set('_serialize', ['fighter']);
        }
    }

        /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($playerId)
    {
        $this->loadModel("Fighters");
        $fighter = $this->Fighters->newEntity();
        if ($this->request->is('post') && !empty($this->request->data)) {
           //$fighter = $this->Fighters->patchEntity($fighter, $this->request->getData());
            //debug($this->request->data); 
            //die();
            $this->Upload->send($this->request->data,$this->Flash,$playerId,$this->Fighters);
        }
               
        
    }
    public function addFighterPicture()
    {
       
        $this->loadModel("Fighters");
        if ($this->request->is("post")){
            $this->Fighters->addFighterPicture($this->request->data);
        }
        /*
        $picture = $this->request->file('picture');
        dd("add fighter picture");
        $this->Fighters->getPlayerFighter($fighterId, $picture);*/

    }
        /**
     * Edit method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fighter = $this->Fighters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fighter = $this->Fighters->patchEntity($fighter, $this->request->getData());
            if ($this->Fighters->save($fighter)) {
                $this->Flash->success(__('The fighter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fighter could not be saved. Please, try again.'));
        }
        $this->set(compact('fighter'));
        $this->set('_serialize', ['fighter']);
    }

     public function upload($playerId){
        if(!empty($this->request->data)){
            //debug($this->request->data); die();
            $this->Upload->send($this->request->data,$this->Flash,$playerId);
            
        }
    }


    /**
     * Delete method
     *
     * @param string|null $id Fighter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
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
