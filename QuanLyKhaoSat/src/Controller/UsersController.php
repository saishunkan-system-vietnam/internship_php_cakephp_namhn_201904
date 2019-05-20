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
        $this->viewBuilder()->setLayout('login');
        if ($this->request->is('post')) {
            $email = htmlentities($this->request->getData('email'));
            $password = htmlentities($this->request->getData('password'));
            $password = md5($password);
            $data = $this->Users->find()
                ->select(['email', 'password', 'id', 'level', 'fullname'])
                ->where(['email' => $email])
                ->first();
            if (isset($data)) {
                $level = $data->level;
                $id = $data->id;
                $name = $data->fullname;
                $user = array($email, $level, $id, $name);
            }
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
                } else {
                    $error = 1;
                    $this->set('error', $error);
                }
            } else {
                $error = 1;
                $this->set('error', $error);
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
            'order' => array('id' => 'asc'),
        );
        $data = $this->paginate("Users");
        $this->set("data", $data);
        $this->set("HgNam", $HgNam);
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $email = htmlentities($this->request->getData('email'));
            $error = $this->Users->find()
                ->where(['email' => $email])
                ->first();
            $password = htmlentities($this->request->getData('password'));
            $password = md5($password);
            $fullname = htmlentities($this->request->getData('fullname'));
            $address = htmlentities($this->request->getData('address'));
            $phone = htmlentities($this->request->getData('phone'));
            $birth = htmlentities($this->request->getData('birth'));
            $level = htmlentities($this->request->getData('level'));
            $secret_q = htmlentities($this->request->getData('secret_q'));
            $secret_a = htmlentities($this->request->getData('secret_a'));
            $result = array($email, $password, $fullname, $address, $password, $birth, $level, $secret_q, $secret_a);
            if (isset($error->email)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Users->query();
                $query->insert(['email', 'password', 'fullname', 'address', 'phone', 'birth', 'level', 'created', 'secret_q', 'secret_a', 'modified'])
                    ->values([
                        'email' => $email,
                        'password' => $password,
                        'fullname' => $fullname,
                        'address' => $address,
                        'phone' => $phone,
                        'birth' => $birth,
                        'level' => $level,
                        'secret_q' => $secret_q,
                        'secret_a' => $secret_a,
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
        if ($this->request->is('post')) {
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
            $secret_q = htmlentities($this->request->getData('secret_q'));
            $secret_a = htmlentities($this->request->getData('secret_a'));
            $result = array($email, $password, $fullname, $address, $password, $birth, $level, $secret_q, $secret_a);
            if (isset($error->email) && $error->id != $data->id) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $password = md5($password);
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
                        'secret_q' => $secret_q,
                        'secret_a' => $secret_a,
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

    public function check()
    {
        $email = $_GET['email'];
        if (isset($id)) {
            $id = $_GET['id'];
            $checkUserId = $this->Users->find()
                ->where(['id' => $id, 'email' => $email])->toArray();
        }
        $checkUser = $this->Users->find()
            ->where(['email' => $email])->toArray();
        // Nếu để object thì !empty vẫn có giá trị
        if (!empty($checkUserId)) {
            echo("Tài Khoản Này Đã Là Của Bạn ^^!");
            die;
        } else if (!empty($checkUser)) {
            echo("Tài Khoản Này Đã Tồn Tại ^^!");
            die;
        } else {
            echo "Tài Khoản Này Sẵn Sàng ^^!";
            die;
        }
    }
}
