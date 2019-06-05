<?php

namespace App\Controller;

use Cake\Event\Event;

class QuestionsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Surveys');
    }

    public function index()
    {
        $this->paginate = array(
            'limit' => 4,
            'order' => array('id' => 'asc'),
        );
        $data = $this->paginate("Questions");
        $this->set("data", $data);
    }

    public function add($id = null)
    {
        $data = $this->Questions->find();
        $this->set("data", $data);
        // ==============================
        // Lấy dữ liệu của bảng Surveys
        $dataS = $this->Surveys->find();
        $this->set("dataS", $dataS);
        // ==============================
        // Lấy dữ liệu có id của Surveys
        $dataId = $this->Surveys->find()
            ->where(['id' => $id])
            ->first();
        $this->set("dataId", $dataId);
        $this->set("id", $id);
        $this->loadComponent('Auth');
        $HgNam = $this->Auth->user();
        $this->set('HgNam',$HgNam);
        // ==============================
        if ($this->request->is('post')) {
            $type_answer = htmlentities($this->request->getData('type_answer'));
            $type_q = htmlentities($this->request->getData('typeQ'));
            if ($type_q == 'Images') {
                $name = $this->request->getData('fileImg')['name'];
                move_uploaded_file($_FILES["fileImg"]["tmp_name"], WWW_ROOT . 'img' . DS . $name);
            } else {
                $name = htmlentities($this->request->getData('name'));
            }
            $error = $this->Questions->find()
                ->where(['name' => $name,])
                ->first();
            $answers = htmlentities($this->request->getData('answers'));
            $typeText = htmlentities($this->request->getData('typeText'));
            $answers = trim($answers,' ,.?!@~#$%^&*()_+<>- ');
            $status = htmlentities($this->request->getData('status'));
            $result = array($name, $type_answer, $answers, $status);
            if (isset($error->name)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                if (empty($answers)) {
                    $answers = $typeText;
                }
                $query = $this->Questions->query();
                $query->insert(['name', 'survey_id', 'type_answer', 'answers', 'status', 'created', 'type_question'])
                    ->values([
                        'name' => $name,
                        'survey_id' => $id,
                        'type_answer' => $type_answer,
                        'answers' => $answers,
                        'status' => $status,
                        'created' => date('Y-m-d H:i:s'),
                        'type_question' => $type_q
                    ])
                    ->execute();
                return $this->redirect(URL . "Surveys/edit/" .$id);
            }
        }

    }

    public function edit($id = null)
    {
        $this->loadComponent('Auth');
        $HgNam = $this->Auth->user();
        $this->set('HgNam',$HgNam);
        //== Lấy thông tin ở bảng Questions == id ==||
        $data = $this->Questions->find()
            ->where(['id' => $id])
            ->first();
        $this->set("data", $data);
        //== Lấy thông tin ở bảng Questions != id ==||
        $data2 = $this->Questions->find()
            ->where(['id !=' => $id]);
        $this->set("data2", $data2);
        //== Lấy "name" ở bảng Surveys ==||
        $dataS = $this->Surveys->find()
            ->where(['id' => $data->survey_id])
            ->first();
        $this->set("dataS", $dataS);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $type_answer = htmlentities($this->request->getData('type_answer'));
            $type_q = htmlentities($this->request->getData('typeQ'));
            if ($type_q == 'Images') {
                $name = $this->request->getData('fileImg')['name'];
                if ($name != '') {
                    if (file_exists(WWW_ROOT . "img" . DS . $data->name)) {
                        @unlink(WWW_ROOT . "img" . DS . $data->name);
                        move_uploaded_file($_FILES["fileImg"]["tmp_name"], WWW_ROOT . 'img' . DS . $name);
                    } else {
                        move_uploaded_file($_FILES["fileImg"]["tmp_name"], WWW_ROOT . 'img' . DS . $name);
                    }
                } else {
                    $name = $data->name;
                }
            } else {
                $name = htmlentities($this->request->getData('name'));
            }
            $survey_id = htmlentities($this->request->getData('survey_id'));
            $error = $this->Questions->find()
                ->where(['name' => $name,
                    'survey_id' => $survey_id,])
                ->first();
            $answers = htmlentities($this->request->getData('answers'));
            $status = htmlentities($this->request->getData('status'));
            $result = array($name, $survey_id, $type_answer, $answers, $status);
            if (isset($error->name) && $error->id != $data->id) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Questions->query();
                $query->update()
                    ->set([
                        'name' => $name,
                        'survey_id' => $survey_id,
                        'type_answer' => $type_answer,
                        'answers' => $answers,
                        'type_question' => $type_q,
                        'status' => $status,
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->where(['id' => $id])
                    ->execute();
                return $this->redirect(URL . "Surveys/edit/$data->survey_id");
            }
        }

    }

    public function delete($id = null)
    {
        //Lấy dữ liệu Question làm 2 việc 1 là để lấy ra id của khảo sát và 2 là lấy tên ảnh để xóa ảnh
        $ques = $this->Questions->find()->where(['id' => $id])->first();
        if ($ques->type_question == "Images") {
            unlink(WWW_ROOT . "img" . DS . $ques->name);
        }
        //================================
        $sur = $this->Surveys->find()->where(['id' => $ques->survey_id])->first();
        $query = $this->Questions->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        return $this->redirect(URL . 'surveys/edit/' . $sur->id);
    }

    public function clickDelete()
    {
        $id = $_GET['id'];
        $query = $this->Questions->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        echo "ok";
        die;

    }
}