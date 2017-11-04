<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Players Controller
 *
 * @property \App\Model\Table\PlayersTable $Players
 *
 * @method \App\Model\Entity\Player[] paginate($object = null, array $settings = [])
 */
class PlayersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $players = $this->paginate($this->Players);

        $this->set(compact('players'));
        $this->set('_serialize', ['players']);
    }

    /**
     * View method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $id=$this->Auth->user('id');
        $player = $this->Players->get($id, [
            'contain' => ['Fighters']]);
        $this->set('player', $player);
        $this->set('_serialize', ['player']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $player = $this->Players->newEntity();
        if ($this->request->is('post')) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__('The player has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The player could not be saved. Please, try again.'));
        }
        $this->set(compact('player'));
        $this->set('_serialize', ['player']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {
        $id=$this->Auth->user('id');
        $player = $this->Players->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            dd($this->request->getData());
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__('The player has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The player could not be saved. Please, try again.'));
        }
        $this->set(compact('player'));
        $this->set('_serialize', ['player']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $player = $this->Players->get($id);
        if ($this->Players->delete($player)) {
            $this->Flash->success(__('The player has been deleted.'));
        } else {
            $this->Flash->error(__('The player could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
// LOGIN 
    public function login()
    {
        if($this->request->is('post')){
            $player = $this -> Auth ->identify();

            // if good login
            if($player){
                $this->Auth->setUser($player);

                return $this->redirect(['controller' => 'Fighters', 'action' => 'view']);
            }
            //bad login
            $this->Flash->error('Incorrect Login');
        }
    }
    public function logout(){
        $this->Flash->error('You are logged out');
        return $this->redirect($this->Auth->logout());
    }

    public function register(){
        $player = $this -> Players -> newEntity();
        if($this->request->is('post')){
            $player = $this-> Players ->patchEntity($player, $this->request->data);
            if ($this->Players->save($player)) {
                $this->Flash->success('You are registered ! ');
                $this->Auth->setUser($player);
                return $this->redirect(['controller' => 'Fighters', 'action' => 'view']);
            }
            else{
                $this->Flash->error('You are not registered ! ');
            }
        }
        $this -> set(compact('player'));
        $this -> set('_serialize',['player']);
    }
    
    public function forgotpassword()
    {
        $showPassword=false;
        $this->set('showPassword', $showPassword);
        // once user entered email
        if($this->request->is('post'))
        {
            //récupérer email adrress
            //dd($this->request->getData());
            $email=$this->request->getData()['email'];
            //get player
            $player=$this->Players->getPlayerByEmail($email);
            //generate pw
            $password = $this->generatepassword();
            $player = $this->Players->patchEntity($player, ['email'=>$email, 'password'=>$password]);
            if ($this->Players->save($player)) 
            {
                $this->Flash->success(__('The player has been saved.'));
                $this->set('password', $password);
                $showPassword=true;
                $this->set('showPassword', $showPassword);
            }
        }
    }

    public function generatepassword()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString ;   
    }
        
    public function home(){
       $this->render();
    }
    public function beforeFilter(Event $event){
        $this-> Auth -> allow(['register', 'home','forgotpassword']); // add later about and index pages
    }
}
