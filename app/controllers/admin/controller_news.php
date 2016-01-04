<?php
class Controller_News extends ControllerBackend
{
    function init()
    {
//        var_dump($this->user);
//        $this->model = new Model_Admin();
//        var_dump($this->user->get('role') != 'admin');die;
        if (!Session::isLoggedIn() || $this->user->get('role') == 'default') {
            Message::add('You must be authorized to enter Admin area', Message::STATUS_ERROR);
            redirect_to('login');
        }
        $this->model = new Model_News();
        $this->view->setLayout('admin_view');
    }

    public function index()
    {
        $pagination = new Pagination(1, 5);
        $pagination->current_page = isset($_GET['page']) ? $_GET['page'] : 1;

        $news = $this->model->get('news');
        $news = $pagination->findByOffset();
        $this->view->setData('news', $news);
        $this->view->setData('pagination', $pagination);
        $this->view->generate_view();
    }

    public function one_news()
    {
        $news_id = (int)trim($_GET['article_id']);
        $news = $this->model->get_one_news($news_id, true);
        //print_r($news); die;
        $this->view->setData('news', $news);
        $this->view->generate_view();
    }


    public function delete($id)
    {
        $this->model->deleteNews($id);
        redirect_to((href('news')));

    }

    public function edit($id)
    {

        if ($this->isPost()) {
            $this->editSave($id);
        }

        $news = $this->model->selectOneNews($id);
        $this->view->setData('news', $news);
        $this->view->generate_view();
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
                if ($_FILES['upload']) {

                    $destination = FS_IMAGES;
                    try {
                        $file = new fileWizard(FS_IMAGES);
                        $file->upload();
                        $data = array_merge($data, $file->getImageInfo());
                    } catch (Exception $e) {
                        Message::add($e->getMessage(), Message::STATUS_ERROR);
                    }

                }
            }

            $this->model->updateNews($data);
            redirect_to(href('news'));
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

    public function add($id = null)
    {
        $this->loadLibrary('htmlelements');
        if (Session::get('loggedIn') == FALSE || $this->user->get('role') == 'default') {
            Message::add('You have to be authorized to add news', Message::STATUS_WARNING);
            redirect_to(href('login'));

        }
        if (isset($id)) {
            if ($this->isPost()) {
                $this->editSave($id);
            }
//            $this->model = $this->load_model('news');
//            var_dump($this->model); die;
            $news = $this->model->selectOneNews($id);
            $this->view->setData('news', $news);
            $this->view->generate_view();
        }
        else {
            //if no ID came
            if ($_POST) {
                $this->addNews();
            }
            $this->view->generate_view();
        }

    }


    public function addNews()
    {

        $data = array(
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'user_id' => $this->user->get('user_id'),
            'created' => strftime("%Y-%m-%d %H:%M:%S", time())

        );

        if (empty($data['title']) || empty($data['body'])) {
            Message::add('Title and body can not be empty', Message::STATUS_ERROR);
            return;
            if (count($_POST)) {
                $this->view->setData('post', $data);

                /// header('Location: ' . URL . 'news/add');
            }
        } else {
            if ($_FILES['upload']) {
                $destination = FS_IMAGES;
                try {
                    $file = new fileWizard($destination);
                    if ($file->upload()) {
                        $data = array_merge($data, $file->getImageInfo());
                        $this->model->addNews($data);
                        redirect_to(href('news'));
                    } else {
                        $this->view->generate_view();
                    }

                } catch (Exception $e) {
                    Message::add($e->getMessage(), Message::STATUS_ERROR);
                }
            }
            //var_dump($data); die;

        }
    }


}