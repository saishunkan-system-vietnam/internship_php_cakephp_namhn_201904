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
            $created = htmlentities($this->request->getData('level'));
            $result = array($name, $catalog_id, $start_time, $end_time, $login_status, $maximum, $created);
            if (isset($error->email)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Surveys->query();
                $query->insert(['name', 'catalog_id', 'start_time', 'end_time', 'login_status', 'maximun', 'created'])
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
                return $this->redirect(SITE_URL . 'Surveys');
            }
        }

    }

    public function edit($id = null)
    {
        $data = $this->Surveys->find()
            ->where(['id' => $id])
            ->first();
        $this->set("data", $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $this->request->getData('email');
            $error = $this->Surveys->find()
                ->where(['email' => $email])
                ->first();
            $password = htmlentities($this->request->getData('password'));
            $fullname = htmlentities($this->request->getData('fullname'));
            $address = htmlentities($this->request->getData('address'));
            $phone = htmlentities($this->request->getData('phone'));
            $birth = htmlentities($this->request->getData('birth'));
            $level = htmlentities($this->request->getData('level'));
            $result = array($email, $password, $fullname, $address, $password, $birth, $level);
            if (isset($error->email) && $error->id != $data->id) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Surveys->query();
                $query->update()
                    ->set([
                        'email' => $email,
                        'password' => $password,
                        'fullname' => $fullname,
                        'address' => $address,
                        'phone' => $phone,
                        'birth' => $birth,
                        'level' => $level
                    ])
                    ->where(['id' => $id])
                    ->execute();
                return $this->redirect(SITE_URL . 'Surveys');
            }
        }

    }

    public function delete($id = null)
    {
        $query = $this->Surveys->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        return $this->redirect(SITE_URL . 'Surveys');
    }

    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect(SITE_URL . 'Surveys/login');
    }

}
