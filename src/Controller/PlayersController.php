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
    public function edit($id = null)
    {
        $player = $this->Players->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
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
                 return $this->redirect(['controller' => 'Fighters', 'action' => 'view']);
            }
            else{
                $this->Flash->error('You are not registered ! ');
            }
        }
        $this -> set(compact('player'));
        $this -> set('_serialize',['player']);
    }
    
    public function forgotpassword(){
        
        if($this->request->is('post')){
            $this->loadModel("Players");
            $email=$this->data['email'];
            $tabPlayers=$this->Players->getAllPlayer();
            foreach( $tabPlayers as $player ){
                
               if(($player['email'] == $email)){
                   
                   $random=rand(75412, 898542);
                   $new_password= md5($new_password);
                   $this->Players->setPasswordPlayer($player['id'], $new_password);
                    
                
            } 
            else{
                
                echo "this email does not exist !";
            }
                
            }   
            
        }
        
    } 
    
    /*function forgot_password() {
        if (!empty($this->data)) {
            $player = $this->Player->findByEmail($this->data['email']);
            if (empty($player)) {
                $this->Session>setflash('Sorry, the email entered was not found.');
                $this->redirect('/players/forgot_password');
            } else {
                $player = $this->__generatePasswordToken($player);
                if ($this->Player->save($Player) && $this->__sendForgotPasswordEmail($Player['email']['id'])) {
                    $this->Session->setflash('Password reset instructions have been sent to your email address.
						You have 24 hours to complete the request.');
                    $this->redirect('/players/login');
                }
            }
        }
    }
  
        */
        
        
    public function home(){
       $this->render();
    }
    public function beforeFilter(Event $event){
        $this-> Auth -> allow(['register', 'home','forgotpassword']); // add later about and index pages
    }
}
