<?php

class Model_User extends Model {

    public function userList(){
        $STH = $this->DB();

        $STH = $STH->query("SELECT user_id, login, role FROM users");
        return $STH->fetch_all(MYSQLI_ASSOC);
    }


    public function insertUser($data)
    {
        $STH = $this->DB();
        extract($data);
        $STH->query("INSERT INTO users (login, password, role)
          VALUES ('$login', '$password', '$role')
          ");
//        $STH->prepare("INSERT INTO users
//          (login, password, role)
//          VALUES (:username, :password, :role)
//          ");
//        $STH::execute(array(
//            ':login' => $data['login'],
//            ':password' => Hash::create_hash('md5', $data['password'], HASH_KEY),
//            ':role' => $data['role'],
//        ));
    }

    public function singleUserList($id)
    {

        $STH = $this->DB();
        $STH = $STH->query("SELECT user_id, login, role FROM users WHERE user_id = '$id'");
        return $STH->fetch_assoc();

    }

    public function editUser($data)
    {
        extract($data);
        $STH = $this->DB();
        $STH = $STH->query("UPDATE users
         SET
             login = '$login',
             password = '$password',
             role = '$role'
             WHERE user_id = '$id'");

    }

    public function deleteUser($id)
    {
        $STH = $this->DB();
        $STH = $STH->query("SELECT role from users WHERE user_id = '$id'");
        $res = $STH->fetch_assoc();
        if($res['role'] == 'owner') {
            return false;
        } else {
            $STH = $this->DB();
            $STH->query("DELETE from users WHERE user_id = '$id'");

        }

    }


}