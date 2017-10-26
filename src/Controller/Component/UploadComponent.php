<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Exception\InternalErrorException;
use Cake\Utility\Text;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component\FlashComponent;


class UploadComponent extends Component
{
    public $max_files=10;
    
    public function send($data,$flash,$playerId,$Fighters){
        if(!empty($data)){
            if(count($data)>$this->max_files){
                throw new InternalErrorException("Error Processing Request. Max number files accepted is {$this->max_files}",1);
            }
            
           // foreach($data as $file){
                $filename=$Fighters->getFighterByPlayerId($playerId)->id;
                $file_tmp_name=$data['avatar_file']['tmp_name'];
                $dir= WWW_ROOT . 'img'.DS.'avatars' ;
                $allowed=array('png','jpg','jpeg','gif');
                            //debug($file_tmp_name); 
                           //die();
                $avatarExtension=strtolower(substr(strrchr($data['avatar_file']['name'],'.'),1));
                //debug($avatarExtension); die();
                if(!in_array($avatarExtension,$allowed)){
                throw new InternalErrorException("There is a problem with your file, please choose another.",1);}
                //}elseif(is_uploaded_file($file_tmp_name)){
                if(is_uploaded_file($file_tmp_name)){
                    //$filename=Text::uuid().'-'.$filename;
                // $filedb=TableRegistry::get('Fighters');
                  //$entity=$filedb->newEntity();
                    //$entity->picture_name=$filename;
                    //$filedb->save($entity);
                    //$newName=$dir.DS.Text::uuid().'-'.$filename;
                    
                  //$this->loadModel("Fighters");
                  $tabfighters=$Fighters->getAllFighters();
                  $filedb=TableRegistry::get('Fighters');
                  $entity=$filedb->newEntity();
                  $x= rand(0,9);
                  $y= rand(0, 14);
                  $occupy=false;
                  foreach ($tabfighters as $fighter){
                   
                    if ($fighter['coordinate_x']==$x && $fighter['coordinate_y']==$y){
                    
                   $occupy=true;   
                }
               }
               
               while ($occupy){
                   $occupy=false;
                  $x= rand(0,9);
                  $y= rand(0, 14);
                  
                  foreach ($tabfighters as $fighter){
                   
                   if ($fighter['coordinate_x']==$x && $fighter['coordinate_y']==$y){
                    
                     $occupy=true;   
                   }
                }
               } 
               
               
               $entity->coordinate_x=$x;
               $entity->coordinate_y=$y;
               $entity->level=1;
               $entity->xp=0;
               $entity->player_id=$playerId;
               $entity->skill_sight=2;
               $entity->skill_strength=1;
               $entity->skill_health=5;
               $entity->current_health=5;
               $entity->name=$data['name'];
               $filedb->save($entity);
               //$this->set(compact('fighter'));
               //$this->set('_serialize', ['fighter']);
                       if ($filedb->save($entity)) {
                             $flash->success(__('The fighter has been saved.'));

                               //return $this->redirect(['action' => 'index']);
                            }
                            else{
                                  $flash->error(__('The fighter could not be saved. Please, try again.'));
                                  
                            }
                            
                           //debug($avatarExtension);
                           //die();
                   $newName=$filename.'.'.$avatarExtension;
                   //move_uploaded_file($file_tmp_name,$dir.DS.$newName);
                    if(move_uploaded_file($file_tmp_name,$dir.DS.$newName)&& is_writable($dir)){
                    //$this->Flash->set('Your picture has been successfully uploaded.', ['element' => 'success']);
                    //$this->loadComponent('Flash');
                    $flash->success('Your picture upload is successfull!'); 
                    //$display_message = "file moved successfully";
                        
                    }
                else{
                    //$this->Flash->set('There is a problem with your picture upload.', ['element' => 'error']);
                    //$this->loadComponent('Flash');
                    $flash->error('There is a problem with your picture upload.'); 
                    //$display_message = " STILL DID NOT MOVE";

                }
                }
            }
            
                }
    }
    
                