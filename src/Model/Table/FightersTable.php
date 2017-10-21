<?php
namespace App\Model\Table;

use Cake\ORM\Table;


class FightersTable extends Table
{

    public function getPlayerFighter($id)
	{
		$fighter = $this->find('all')->where(['player_id' => $id]);
		return $fighter ;
	}

	public function addFighterPicture($fighterid, $fighterpicture)
	{
		query()->update()->set(['image' => $fighterpicture])->where(['id' => $fighterid ])->execute();
	}
 
    public function getBestFighter()
    {
	    $best=$this->find('all')->order(['level'=>'DESC'])->first();
	    return $best;
    }
}
