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
    
    public function send($data,$flash){
        if(!empty($data)){
            if(count($data)>$this->max_files){
                throw new InternalErrorException("Error Processing Request. Max number files accepted is {$this->max_files}",1);
            }
            
            foreach($data as $file){
                $filename=$file['name'];
                $file_tmp_name=$file['tmp_name'];
                $dir= WWW_ROOT . 'img'.DS.'avatars' ;
                $allowed=array('png','jpg','jpeg');
                            //debug($filename); die();

                if(!in_array(substr(strrchr($filename,'.'),1),$allowed)){
                throw new InternalErrorException("There is a problem with your file, please choose another.",1);}
                //}elseif(is_uploaded_file($file_tmp_name)){
                if(is_uploaded_file($file_tmp_name)){
                    $filename=Text::uuid().'-'.$filename;
                    $filedb=TableRegistry::get('Fighters');
                    $entity=$filedb->newEntity();
                    $entity->picture_name=$filename;
                    $filedb->save($entity);
                    $newName=$dir.DS.Text::uuid().'-'.$filename;
                    
                    if(move_uploaded_file($file_tmp_name,$newName)&& is_writable($dir)){
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
}