<?php

class homeController extends Controller  {

	public function index(){
		

		$data = array(
			'quantidade'=> 20,
			'nome'=> "Rogerio",
			'idade'=> 30
			 );




		$this->loadTemplate('home',$data);
		

	}
}