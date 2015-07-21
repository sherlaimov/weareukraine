<?php

class Model_Login extends Model {

    public function authenticate($login = '', $password = '') {

                //VALIDATION AGAINST DB RECORDS
                //$conn = $this->DB();
                $this->where('login', $login);
                $this->where('password', $password);
                $result = $this->get('user'); //mysqli_result object


        // Не получилось воспользоваться query!!??
                $sql = "SELECT * FROM user ";
                $sql .= "WHERE login = '$username' ";
                $sql .= "AND password = '$password' ";
                $sql .= "LIMIT 1";

        return isset($result) ? (array_shift($result)) : FALSE;
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
