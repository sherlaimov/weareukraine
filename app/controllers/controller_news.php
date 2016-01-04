<?php

class Controller_News extends Controller
{

    function init()
    {

        //$this->model = $this->load_model('news');
        $this->model = new Model_News();

    }

    function index()
    {

        $pagination = new Pagination(1, 5);
        $pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        //var_dump($pagination);
//        if ($this->user->getId() && Session::isLoggedIn()) {
//            $news = $pagination->findByOffsetandUser( $this->user->get('user_id') );

        $news = $pagination->findByOffset();

        $this->view->setData('news', $news);
        $this->view->setData('pagination', $pagination);
        $this->view->generate_view();
    }

    function one_news()
    {
        $this->loadLibrary('htmlelements');
        $news_id = (int)$_GET['article_id'];
        $news = $this->model->get_one_news($news_id, true);
        $comment = new Comment();
        $newsComments = $comment->getNewsComments($news_id);
        $this->view->setData('news', $news);
        $this->view->setData('comment', $newsComments);
        $this->view->generate_view();
    }

    public function addComment($news_id)
    {
        if ($this->isPost()) {
            $news_id = (int)$news_id;
            $user_id = $this->user->getId();
            $body = htmlspecialchars(trim($_POST['body']));
            $comment = new Comment();
            $comment->make($news_id, $user_id, $body);
//            $comment = Comment::make($news_id, $user_id, $body);
//            $comment->insertComment();
//            redirect_to(href('news'));
            redirect_to(href('news/one_news', array('article_id' => $news_id)));

        }
    }

    public function updateComment($commentId)
    {
        $answer = array('status' => 'error', 'text' => '');

        if ($this->isPost()) {
            if ( ! empty($_POST['newComment'])) {
                $user_id = $this->user->getId();
                $news_id =  $_POST['newsId'];
                $newComment['body'] = $_POST['newComment'];
                $comment = new Comment();
                $comment->edit($commentId, $newComment);
                $answer['status'] = 'ok';
            } else {
                $answer['error'] = 'newComment is empty';
            }
        }
        echo json_encode($answer);
        die;
    }

    public function delete($id)
    {
        $this->model->deleteNews($id);
        redirect_to(href('news'));

    }

//    public function edit($id)
//    {
//
//        if ($this->isPost()) {
//            $this->editSave($id);
//        }
//
//        $news = $this->model->selectOneNews($id);
//        $this->view->setData('news', $news);
//        $this->view->generate_view();
//    }

    public function addCommentAjax()
    {
        $answer = array('status' => 'error', 'text' => '');

        if ($this->isPost()) {
            if (!empty($_POST['body'])) {
                $news_id = (int)$_POST['news_id'];
                $user_id = $this->user->getId();
                $body = htmlspecialchars(trim($_POST['body']));
                $comment = new Comment();
                $comment->make($news_id, $user_id, $body);
                $answer['status'] = 'ok';
            } else {
                $answer['error'] = 'body is empty';
            }
        }

        echo json_encode($answer);
        die;
    }

    public function loadCommentListAjax()
    {

        if (isset($_GET['newsId'])) {

            $this->loadLibrary('htmlelements');

            $newsId = $_GET['newsId'];
            $comment = new Comment();
            $newsComments = $comment->getNewsComments($newsId);

            foreach ($newsComments as $comment) {

                $output = '<li>
                <div class="commenterImage" id="comment-' . $comment['comment_id'] . '" >';
                $output .= isset($comment['profile_thumb']) ? profileImageThumb($comment['profile_thumb']) :
                    '<img alt="User Pic" src="http://lorempixel.com/50/50/people/9"
                            class="img-circle img-responsive">';
                $output .= '</div><div class="commentText">';
//                $output .= '<a href="/profile/user?user_id=' . $userData['user_id'] . '">' .  $userData['first_name'] . ' ' . $userData['last_name'] . '</a>';
                $output .= '<a href="' . href('profile/user', array('user_id' => $comment['user_id'])) . '">' .
                    $comment['first_name'] . ' ' . $comment['last_name'] . '</a>';
                $output .= '<p class="">' . $comment['body'] . '</p>';
                $output .= '<a onclick="editComment(' . $comment['comment_id'] . ')" href="javascript:void(0)">Edit</a>';
                $output .= '<span class="date sub-text">' . $comment['created'];
                $output .= '</span></div></li>';
                echo $output;
            }
        } else {
            echo 'newsId is empty';
        }

        die;
    }

    public function editSave($id)
    {
        $data = array();
        $data['id'] = $id;

        //var_dump($_FILES);die;

        if (!empty($_POST['title']) && !empty ($_POST['body'])) {
            $data['title'] = trim($_POST['title']);
            $data['body'] = trim($_POST['body']);
            $data['created'] = strftime("%Y-%m-%d %H:%M:%S", time());
            if (isset($_FILES['upload']) && !empty($_FILES['upload']['name'])) {
                $file = new File($_FILES['upload']);
                $imageData = $file->getImageInfo();
                $data = array_merge($data, $imageData);

                if (move_uploaded_file($data['tmp_name'], $data['file_path'])) {
                    //echo 'BELGO'; die;
                    if (isset($_POST['width'])) {
                        $value = $_POST['width'];
                        if ($file->createThumb($value, $value)) {
                            $data['thumb_name'] = $file->thumbName;
                        } else {
                            return false;
                        }
                    } else {
                        $file->createThumb(150, 150);
                        $data['thumb_name'] = $file->thumbName;
                    }
                }
            }

            $this->model->updateNews($data);
            header('Location: ' . URL . 'news');
            exit;
        } else {
            Message::add('Both body and title must be filled', Message::STATUS_ERROR);
            if (count($_POST)) {
                $data = array(
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'id' => trim($id));
            }
            $this->view->setData('data', $data);
            //header('Location: ' . URL . 'news/edit/' . $id);
            //exit;
        }
    }

}