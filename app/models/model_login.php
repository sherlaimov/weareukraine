<?php

class Model_Login extends Model {

    public function getUserByLogin($login) {

                //VALIDATION AGAINST DB RECORDS
                $conn = $this->DB();
                $result = $conn->query("SELECT * FROM user WHERE login = '$login' LIMIT 1"); //mysqli_result object
                //var_dump($result); die();
                $user = $result->fetch_assoc(); //returns array or NULL

        if ( $result->num_rows) {
           return $user;
        } else {
            return false;
        }


    }

    public function DB()
    {
        $conn = new mysqli('localhost', 'root', '', 'mvc') or die('There was a problem connection to DB');
        //echo 'connect_errno ' . $conn->connect_error . '<br/>';
        //var_dump($conn); die();
        //$query = $conn->query("SELECT * FROM posts ORDER BY id DESC LIMIT 5");
        //var_dump($query); die();
        return $conn;
    }

    

}
