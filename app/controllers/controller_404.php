<?php

class Controller_404 extends Controller
{
	
	function index()
	{

		//$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		//header("Status: 404 Not Found");
		//header('Location: ' . URL . '404/index');

		$this->view->generate_view();
	}

}
