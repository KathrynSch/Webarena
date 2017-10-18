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
		$this->loadModel('Fighters');
		$fighterlist=$this->Fighters->test();
		$this->set("fighterlist", $fighterlist);
		$bestfighter=$this->Fighters->getBestFighter();
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