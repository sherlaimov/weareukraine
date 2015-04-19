<?php

class Model_Login extends Model {

    public function getUserByLogin($login) {

                //VALIDATION AGAINST DB RECORDS
                $conn = $this->DB();
                $result = $conn->query("SELECT * FROM users WHERE login = '$login' LIMIT 1"); //mysqli_result object
                //var_dump($result); die();
                $user = $result->fetch_assoc(); //returns array or NULL

        if ( $result->num_rows) {
           return $user;
        } else {
            return false;
        }


    }

    

}
