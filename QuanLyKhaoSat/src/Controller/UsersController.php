<?php

namespace App\Controller;

use Cake\Cache\Cache;


class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('demo');
        if ($this->request->is('post')) {
            $email = htmlentities($this->request->getData('email'));
            $password = htmlentities($this->request->getData('password'));
            $data = $this->Users->find()
                ->select(['email', 'password', 'id', 'level'])
                ->where(['email' => $email])
                ->first();
            $level = $data->level;
            $id = $data->id;
            $user = array($email, $level, $id);
            if (isset($data->email)) {
                if ($password == $data->password) {
                    $this->Auth->setUser($user);
                    $link = Cache::read('link');
                    if (!empty($link)) {
                        Cache::delete('link');
                        return $this->redirect(URL . $link);
                    } else {
                        return $this->redirect(URL . 'users');
                    }
                }
            }
        }
    }

    public function index()
    {
        $HgNam = ($this->Auth->user());
        $this->Users->find('all', array(
            'order' => "FIELD(Users.level, 'Admin','Member') ASC"
        ));
        $this->paginate = array(
            'limit' => 4,
//            'order' => array('id' => 'asc'),
        );
        $data = $this->paginate("Users");
        $this->set("data", $data);
        $this->set("HgNam", $HgNam);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = htmlentities($this->request->getData('email'));
            $error = $this->Users->find()
                ->where(['email' => $email])
                ->first();
            $password = htmlentities($this->request->getData('password'));
            $fullname = htmlentities($this->request->getData('fullname'));
            $address = htmlentities($this->request->getData('address'));
            $phone = htmlentities($this->request->getData('phone'));
            $birth = htmlentities($this->request->getData('birth'));
            $level = htmlentities($this->request->getData('level'));
            $result = array($email, $password, $fullname, $address, $password, $birth, $level);
            if (isset($error->email)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Users->query();
                $query->insert(['email', 'password', 'fullname', 'address', 'phone', 'birth', 'level', 'created', 'modified'])
                    ->values([
                        'email' => $email,
                        'password' => $password,
                        'fullname' => $fullname,
                        'address' => $address,
                        'phone' => $phone,
                        'birth' => $birth,
                        'level' => $level,
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->execute();

                return $this->redirect(URL . 'users');
            }
        }

    }

    public function edit($id = null)
    {
        $data = $this->Users->find()
            ->where(['id' => $id])
            ->first();
        $this->set("data", $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $this->request->getData('email');
            $error = $this->Users->find()
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
                $query = $this->Users->query();
                $query->update()
                    ->set([
                        'email' => $email,
                        'password' => $password,
                        'fullname' => $fullname,
                        'address' => $address,
                        'phone' => $phone,
                        'birth' => $birth,
                        'level' => $level,
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->where(['id' => $id])
                    ->execute();
                return $this->redirect(URL . 'users');
            }
        }

    }

    public function delete($id = null)
    {
        $query = $this->Users->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        return $this->redirect(URL . 'users');
    }

    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect(URL . 'users/login');
    }

}
