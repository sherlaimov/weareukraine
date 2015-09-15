<?php

class Model_Admin extends Model
{
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

    public function get_news()
    {
        return $res = $this->get('news', 7, 'ORDER BY id DESC');
    }

    public function get_one_news()
    {
        $this->where('id', $_GET['article_id']);
        $res = $this->get('news');
        return $res;
    }

    public function addNews($data, $image = NULL)
    {

        $insertData = array(
            'title' => $data['title'],
            'body' => $data['body'],
            'image_name' => $data['image_name'],
            'thumb' => $data['thumb_name']
        );

        //print_r($insertData); die;
        return $this->insert('news', $insertData);

    }

    public function deleteNews($id)
    {
        $this->where('id', $id);
        return $this->delete('news');
    }

    public function selectOneNews($id)
    {
        $this->where('id', $id);
        return $this->get('news', 1);

    }

    public function updateNews($data)
    {
        $this->where('id', $data['id']);

        if ($data['image_name']) {
            $updateData = array(
                'title' => $data['title'],
                'body' => $data['body'],
                'image_name' => $data['image_name'],
                'thumb' => $data['thumb_name']
            );
        } else {
            $updateData = array(
                'title' => $data['title'],
                'body' => $data['body']);
        }

        return $this->update('news', $updateData);
    }

    public function countAll(){

        $res = $this->query("SELECT COUNT(*) FROM news");
        $res = array_shift($res);
        $count = array_values($res)[0];
        return $count;

    }


}