<?php

class controller_404 extends Controller
{
	
	function index()
	{
		$this->generate('404_view.php', 'template_view.php');
	}

}
