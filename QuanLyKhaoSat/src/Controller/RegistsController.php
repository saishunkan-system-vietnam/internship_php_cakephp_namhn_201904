<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Cache\Cache;


class RegistsController extends AppController
{
    public function initialize()
    {

    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Users');
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('regists');
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
                $query->insert(['email', 'password', 'fullname', 'address', 'phone', 'birth', 'level', 'created', 'modified'])
                    ->values([
                        'email' => $email,
                        'password' => $password,
                        'fullname' => $fullname,
                        'address' => $address,
                        'phone' => $phone,
                        'birth' => $birth,
                        'level' => "Member",
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->execute();
                $link = Cache::read('link');
                if (!empty($link)) {
                    Cache::delete('link');
                    return $this->redirect(URL . $link);
                }  else {
                    return $this->redirect(URL . 'users/login');
                }
            }
        }
    }
}