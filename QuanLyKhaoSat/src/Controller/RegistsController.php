<?php

namespace App\Controller;

use Cake\Event\Event;

class RegistsController extends AppController
{
    public function initialize()
    {
//        parent::initialize();
//        $this->loadComponent('Paginator');
    }
    public function beforeFilter(Event $event)
    {
        $this->loadModel('Users');
    }

    public function regist()
    {
        $this->viewBuilder()->setLayout('demo');
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

                return $this->redirect(URL . 'users/login');
            }
        }
    }
    public function index(){
        
    }
}