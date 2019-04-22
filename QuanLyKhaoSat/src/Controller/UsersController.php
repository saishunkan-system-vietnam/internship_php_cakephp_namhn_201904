<?php

namespace App\Controller;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function index()
    {
        $this->Users->find('all', array(
            'order' => "FIELD(Users.level, 'Admin','Member') ASC"
        ));
        $this->paginate = array(
            'limit' => 4,
//            'order' => array('id' => 'asc'),
        );
        $data = $this->paginate("Users");
        $this->set("data", $data);
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $data = $this->Users->find()
                ->where(['email' => $email])
                ->first();
            if (isset($data->email)) {
                $this->set("data", $data);
            } else {
                $password = $this->request->getData('password');
                $fullname = $this->request->getData('fullname');
                $address = $this->request->getData('address');
                $phone = $this->request->getData('phone');
                $birth = $this->request->getData('birth');
                $level = $this->request->getData('level');
                $query = $this->Users->query();
                $query->insert(['email', 'password', 'fullname', 'address', 'phone', 'birth', 'level'])
                    ->values([
                        'email' => $email,
                        'password' => $password,
                        'fullname' => $fullname,
                        'address' => $address,
                        'phone' => $phone,
                        'birth' => $birth,
                        'level' => $level
                    ])
                    ->execute();

                return $this->redirect(SITE_URL . 'users');
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
//            if (isset($error->email) && $error->id != $data->id) {
//                $this->set("error", $error);
//            } else {
            $password = $this->request->getData('password');
            $fullname = $this->request->getData('fullname');
            $address = $this->request->getData('address');
            $phone = $this->request->getData('phone');
            $birth = $this->request->getData('birth');
            $level = $this->request->getData('level');
            if (isset($error->email) && $error->id != $data->id) {
                $this->set("error", $error);
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
                        'level' => $level
                    ])
                    ->where(['id' => $id])
                    ->execute();
                return $this->redirect(SITE_URL . 'users');
            }
        }

    }

    public function delete($id = null)
    {
        $query = $this->Users->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        return $this->redirect(SITE_URL . 'users');
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('demo');
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $password = $this->request->getData('password');
            $data = $this->Users->find()
                ->select(['email', 'password'])
                ->where(['email' => $email])
                ->first();
            if (isset($data->email)) {
                if ($password == $data->password) {
                    $this->Auth->setUser($email);
                    return $this->redirect(SITE_URL . 'users');
                }
            }
        }
    }

    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect(SITE_URL . 'users/login');
    }

}
