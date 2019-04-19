<?php

namespace App\Controller;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function pagelist()
    {
        $this->paginate = array(
            'limit' => 4,// mỗi page có 4 record
            'order' => array('id' => 'asc'),//giảm dần theo id
        );
        $data = $this->paginate("Users");
        $this->set(compact('data'));
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'pagelist']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function edit($id)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function login()
    {
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
                    return $this->redirect(SITE_URL.'users');
                }
            }
        }
    }
    public function logout(){
        $this->Flash->success('You are logged out');
        return $this->redirect($this->Auth->logout());
    }
}