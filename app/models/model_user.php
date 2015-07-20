<?php

class Model_User extends Model {

    public function getUsers(){

       return $this->query("SELECT user_id, login, role FROM user");

    }


    public function insertUser($data)
    {
        $insertData = array(
            'login' => $data['login'],
            'password' => $data['password'],
            'role' => $data['role']
        );

       return ($this->insert('user', $insertData)) ? TRUE : FALSE;

    }

    public function getUserById($id)
    {
        $this->where('user_id', $id);
        return $this->get('user');
       // $STH = $STH->query("SELECT user_id, login, role FROM users WHERE user_id = '$id'");


    }

    public function editUser($data)
    {
        $updateData = array(
            'login' => $data['login'],
            'password' => $data['password'],
            'role' => $data['role']
        );
        $this->where('user_id', $data['user_id']);
        return ($this->update('user', $updateData)) ? TRUE : FALSE;

    }

    public function deleteUser($id)
    {

       $res = $this->query("SELECT role FROM user WHERE user_id = $id");
       $res = array_shift($res);
        if($res['role'] == 'owner') {
            return false;
        } else {
            $this->where('user_id', $id);
            return ($this->delete('user')) ? true : false;

        }

    }


}