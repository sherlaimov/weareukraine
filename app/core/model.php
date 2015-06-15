<?php

class Model
{

    public function DB()
    {
        $conn = new mysqli('localhost', 'root', 'secret', 'mvc') or die('There was a problem connection to DB');
         //echo 'connect_errno ' . $conn->connect_error . '<br/>';
        //var_dump($conn); die();
        //$query = $conn->query("SELECT * FROM posts ORDER BY id DESC LIMIT 5"); 
        //var_dump($query); die();
        return $conn;
    }

}