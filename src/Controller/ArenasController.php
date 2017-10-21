<?php
namespace App\Controller;
use App\Controller\AppController;
/**
* Personal Controller
* User personal interface
*
*/
class ArenasController extends AppController
{
	public function index()
	{
		//$this->set('myname', "Julien Falconnet");
		$this->loadModel('Fighters'); //load la table model
		$fighterlist=$this->Fighters->test();
		$this->set("fighterlist", $fighterlist); //set une variable qu'on veut dans la vue
		$bestfighter=$this->Fighters->getBestFighter();  //
		$bestfighter=$bestfighter->toArray();
		$this->set("bestfighter", $bestfighter);
		//pr($fighterlist->toArray());
	}
	public function login()
	{

	}
	public function fighter()
	{
	}
	public function sight()
	{
	}public function diary()
	{
	}
}