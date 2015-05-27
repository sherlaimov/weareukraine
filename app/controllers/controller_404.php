<?php

class Controller_404 extends Controller
{
	
	function index()
	{
		die('404');
		//$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		//header('Location:'.$host.'404');

		$this->generate('404_view.php', 'template_view.php');
	}

}
