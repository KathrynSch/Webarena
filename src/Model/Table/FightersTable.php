<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class FightersTable extends Table
{ 
	function test(){
		return("ok");
	}

	function getBestFighter(){
		$query = TableRegistry::get('fighters')->find()->order(['level'=> 'DESC'])->first();  //query bdd
		return($query);
	}
}