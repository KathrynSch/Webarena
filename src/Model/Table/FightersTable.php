<?php
namespace App\Model\Table;

use Cake\ORM\Table;


class FightersTable extends Table
{

    public function test()
{
$ok="ok";
return $ok;
}
 
    public function getBestFighter()
    {
    $best=$this->find('all')->order(['level'=>'DESC'])->first();
    return $best;
    }

}
