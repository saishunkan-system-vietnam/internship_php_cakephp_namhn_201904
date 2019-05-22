<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\Cache\Cache;
use Cake\Mailer\Email;

//use Cake\Mailer\Mailer;
//
//class UserMailer extends Mailer {
//    public function resetPassword($user)
//    {
//        $this
//            ->subject('Reset Password')
//            ->to($user->email)
//            ->set(['token' => $user->token]);
//    }
//}
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
            $email = htmlentities($this->request->getData('email'));
            $data = $this->Users->find()
                ->where(['email' => $email])
                ->first();
            if (isset($data->email)) {
                $this->set("data", $data);
            } else {
                $password = htmlentities($this->request->getData('password'));
                $password = md5($password);
                $fullname = htmlentities($this->request->getData('fullname'));
                $address = htmlentities($this->request->getData('address'));
                $phone = htmlentities($this->request->getData('phone'));
                $birth = htmlentities($this->request->getData('birth'));
                $secret_q = htmlentities($this->request->getData('secret_q'));
                $secret_a = htmlentities($this->request->getData('secret_a'));
                $query = $this->Users->query();
                $query->insert(['email', 'password', 'fullname', 'address', 'phone', 'birth', 'level', 'secret_q', 'secret_a', 'created', 'modified'])
                    ->values([
                        'email' => $email,
                        'password' => $password,
                        'fullname' => $fullname,
                        'address' => $address,
                        'phone' => $phone,
                        'birth' => $birth,
                        'level' => "Member",
                        'secret_q' => $secret_q,
                        'secret_a' => $secret_a,
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->execute();
                $link = Cache::read('link');
                if (!empty($link)) {
                    Cache::delete('link');
                    return $this->redirect(URL . $link);
                } else {
                    return $this->redirect(URL . 'users/login');
                }
            }
        }
    }

    public function forgotpass()
    {
        $this->viewBuilder()->setLayout('regists');
        if ($this->request->is('post')) {
            $users = $this->request->getData('email');
            $secret_q = htmlentities($this->request->getData('secret_q'));
            $secret_a = htmlentities($this->request->getData('secret_a'));
            $forgot = $this->Users->find()
                ->where(['email' => $users])->first();
            if (!empty($forgot) && $secret_q == $forgot->secret_q && $secret_a == $forgot->secret_a) {
                $email = new Email('default');
                $email->setFrom(['HoagNgNam@gmail.com' => 'Nam HN'])
                    ->setTo($users)
                    ->setSubject('Lấy Lại Mật Khẩu')
                    ->send('Mời Bạn Click đường link để lấy lại mật khẩu : ' . URL . 'regists/updatepass/' . $users);
                $success = "success";
                $this->set('success', $success);

            } else {
                $error = "error";
                $this->set('error', $error);
            }
        }
    }

    public function updatepass($email = null)
    {
        $this->viewBuilder()->setLayout('regists');
        if ($this->request->is('post')) {
            $password1 = htmlentities($this->request->getData('password1'));
            $password2 = htmlentities($this->request->getData('password2'));
            if ($password1 == $password2) {
                $password = md5($password1);
                $query = $this->Users->query();
                $query->update()
                    ->set([
                        'password' => $password,
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->where(['email' => $email])
                    ->execute();
                $success = "success";
                $this->set('success', $success);
                return $this->redirect(URL . "regists/success");
            } else {
                $password_error = "password_error";
                $this->set('passwrod_error', $password_error);
            }
        }
    }

    public function success()
    {
        $this->viewBuilder()->setLayout('regists');
    }
}
