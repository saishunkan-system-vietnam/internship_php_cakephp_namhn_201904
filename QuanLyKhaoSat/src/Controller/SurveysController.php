<?php

namespace App\Controller;

use Cake\Event\Event;

class SurveysController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Catalogs');
        $this->loadModel('Questions');
    }


    public function index()
    {
        $this->paginate = array(
            'limit' => 4,
            'order' => array('id' => 'asc'),
        );
        $data = $this->paginate("Surveys");
        $this->set("data", $data);
    }

    public function add()
    {
        $catalog = $this->Catalogs->find()
            ->select(['id', 'name']);
        $this->set("catalog", $catalog);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlentities($this->request->getData('name'));
            $error = $this->Surveys->find()
                ->where(['name' => $name])
                ->first();
            $catalog_id = htmlentities($this->request->getData('catalog_id'));
            $start_time = htmlentities($this->request->getData('start_time'));
            $end_time = htmlentities($this->request->getData('end_time'));
            $login_status = htmlentities($this->request->getData('login_status'));
            $maximum = htmlentities($this->request->getData('maximum'));
            $created = htmlentities($this->request->getData('created'));
            $result = array($name, $catalog_id, $start_time, $end_time, $login_status, $maximum, $created);
            if (isset($error->email)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Surveys->query();
                $query->insert(['name', 'catalog_id', 'start_time', 'end_time', 'login_status', 'maximum', 'created'])
                    ->values([
                        'name' => $name,
                        'catalog_id' => $catalog_id,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'login_status' => $login_status,
                        'maximum' => $maximum,
                        'created' => $created
                    ])
                    ->execute();
                return $this->redirect(URL . 'Surveys');
            }
        }

    }

    public function edit($id = null)
    {
        $data = $this->Surveys->find()
            ->where(['id' => $id])
            ->first();
        $this->set("data", $data);
        // Lấy tên danh mục khảo sát
        $catalog = $this->Catalogs->find()
            ->where(['id' => $data->catalog_id])
            ->first();
        $this->set("catalog", $catalog);
        //==============================
        // Lấy tên danh mục khảo sát khác
        $select = $this->Catalogs->find()
            ->where(['id !=' => $data->catalog_id]);
        $this->set("select", $select);
        //==================================
        $data2 = $this->Questions->find()
            ->where(['survey_id' => $id]);
        $this->set("data2", $data2);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->request->getData('name');
            $error = $this->Surveys->find()
                ->where(['name' => $name])
                ->first();
            $catalog_id = htmlentities($this->request->getData('catalog_id'));
            $start_time = htmlentities($this->request->getData('start_time'));
            $end_time = htmlentities($this->request->getData('end_time'));
            $login_status = htmlentities($this->request->getData('login_status'));
            $maximum = htmlentities($this->request->getData('maximum'));
            $created = htmlentities($this->request->getData('created'));
            $result = array($name, $catalog_id, $start_time, $end_time, $login_status, $maximum , $created);
            if (isset($error->name) && $error->id != $data->id) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Surveys->query();
                $query->update()
                    ->set([
                        'name' => $name,
                        'catalog_id' => $catalog_id,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'login_status' => $login_status,
                        'maximum' => $maximum,
                        'created' => $created,
                    ])
                    ->where(['id' => $id])
                    ->execute();
                return $this->redirect(URL . 'Surveys');
            }
        }

    }

    public function delete($id = null)
    {
        $query = $this->Surveys->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        return $this->redirect(URL . 'Surveys');
    }


    public function listQ($id = null)
    {
        $dataS = $this->Surveys->find()
            ->where(['id' => $id])
            ->first();
        $this->set("dataS", $dataS);
        $data = $this->Questions->find()
            ->where(['survey_id' => $id]);
        $this->set("data", $data);
//        foreach ($data as $value) {
//            if (isset($value->answers)) {
//                $answers = $value->answers;
//                $answers = explode(',', $answers);
//                $this->set("answers", $answers);
//            }
//        }
    }
}
