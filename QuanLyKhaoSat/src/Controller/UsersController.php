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
            if (isset($data->email)) {
                $level = $data->level;
                $id = $data->id;
                $name = $data->fullname;
                $user = array($email, $level, $id, $name);
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
        if ($HgNam[1] == "Member") {
            return $this->redirect(URL . "actions");
        } else {
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
    }

    public function add()
    {
        $HgNam = ($this->Auth->user());
        if ($HgNam[1] == "Member") {
            return $this->redirect(URL . "actions");
        } else {
            $HgNam = ($this->Auth->user());
            $this->set("HgNam", $HgNam);
            if ($this->request->is('post')) {
                $email = htmlentities($this->request->getData('email'));
                $error = $this->Users->find()
                    ->where(['email' => $email])
                    ->first();
                $password1 = htmlentities($this->request->getData('password1'));
                $password2 = htmlentities($this->request->getData('password2'));
                $fullname = htmlentities($this->request->getData('fullname'));
                $address = htmlentities($this->request->getData('address'));
                $phone = htmlentities($this->request->getData('phone'));
                $birth = htmlentities($this->request->getData('birth'));
                $level = htmlentities($this->request->getData('level'));
                $secret_q = $this->request->getData('secret_q');
                $secret_a = htmlentities($this->request->getData('secret_a'));
                $result = array($email, $password1, $password2, $fullname, $address, $phone, $birth, $level, $secret_q, $secret_a);
                if (isset($error->email)) {
                    $this->set("error", $error);
                    $this->set("result", $result);
                } else {
                    if ($password1 == $password2) {
                        $password1 = md5($password1);
                        $query = $this->Users->query();
                        $query->insert(['email', 'password', 'fullname', 'address', 'phone', 'birth', 'level', 'created', 'secret_q', 'secret_a', 'modified'])
                            ->values([
                                'email' => $email,
                                'password' => $password1,
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
                    } else {
                        $errorPass = "errorPass";
                        $this->set("errorPass", $errorPass);
                        $this->set("result", $result);
                    }
                }
            }

        }
    }

    public function edit($id = null)
    {
        $HgNam = ($this->Auth->user());
        if ($HgNam[1] == "Member") {
            return $this->redirect(URL . "actions");
        } else {
            $HgNam = ($this->Auth->user());
            $this->set("HgNam", $HgNam);
            $data = $this->Users->find()
                ->where(['id' => $id])
                ->first();
            $this->set("data", $data);
            if ($this->request->is('post')) {
                $email = $this->request->getData('email');
                $error = $this->Users->find()
                    ->where(['email' => $email])
                    ->first();
                $password1 = htmlentities($this->request->getData('password1'));
                $password2 = htmlentities($this->request->getData('password2'));
                $fullname = htmlentities($this->request->getData('fullname'));
                $address = htmlentities($this->request->getData('address'));
                $phone = htmlentities($this->request->getData('phone'));
                $birth = htmlentities($this->request->getData('birth'));
                $level = htmlentities($this->request->getData('level'));
                $secret_q = $this->request->getData('secret_q');
                $secret_a = htmlentities($this->request->getData('secret_a'));
                $result = array($email, $password1, $password2, $fullname, $address, $phone, $birth, $level, $secret_q, $secret_a);
                if (isset($error->email) && $error->id != $data->id) {
                    $this->set("error", $error);
                    $this->set("result", $result);
                } else {
                    if ($password1 == '') {
                        $query = $this->Users->query();
                        $query->update()
                            ->set([
                                'email' => $email,
                                'password' => $data->password,
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
                    } else {
                        if ($password1 == $password2) {
                            $password = md5($password1);
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
                        } else {
                            $errorPass = "errorPass";
                            $this->set("errorPass", $errorPass);
                            $this->set("result", $result);
                        }
                    }
                }
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
