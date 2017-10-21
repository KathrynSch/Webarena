<?php

namespace App\Controller;

class IndexController extends AppController
{
	public function about(id, plouf){
		$this->set('test', $id);
		$this->render();
	}
}