<?php

class Controller_404 extends ControllerBackend
{
	
	function index()
	{

		//$host = 'http://'.$_SERVER['HTTP_HOST'].'/'
		//header("Status: 404 Not Found");
        header('HTTP/1.1 404 Not Found');

        //header('Location: ' . URL . '404/index');
echo '404<br/>';

		$this->view->generate_view();
	}

}
