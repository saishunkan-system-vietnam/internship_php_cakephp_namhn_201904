<?php

namespace App\Controller;

use Cake\Cache\Cache;
use Cake\Event\Event;

class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Groups');
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
            $this->paginate = array(
                'limit' => 8,
                'order' => array('id' => 'asc'),
            );
            $data = $this->Users->find()
                ->where(['restore' => 1]);
            $data = $this->paginate($data);
            $this->set("data", $data);
            $this->set("HgNam", $HgNam);
            $recycleBin = $this->Users->find()
                ->where(['restore' => 0])->toArray();
            $this->set("recycleBin", $recycleBin);
            $dem = $this->Users->find()
                ->where(['restore' => 1])->count();
            $this->set("dem", $dem);
        }
    }

    public function lists($id = null)
    {
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        $data = $this->Users->find()
            ->where(['id' => $id])
            ->first();
        $this->set('data', $data);
        $group = $this->Groups->find()
            ->where(['user_id' => $data->id,]);
        $this->set('user', $group);
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
                } else if (strtotime($birth) >= strtotime(date('Y-m-d H:i:s'))) {
                    $errorBirth = "erroBirth";
                    $this->set("errorBirth", $errorBirth);
                    $this->set("result", $result);
                } else {
                    if ($password1 == $password2) {
                        $password1 = md5($password1);
                        $query = $this->Users->query();
                        $query->insert(['email', 'password', 'restore', 'fullname', 'address', 'phone', 'birth', 'level', 'created', 'secret_q', 'secret_a', 'modified'])
                            ->values([
                                'email' => $email,
                                'password' => $password1,
                                'fullname' => $fullname,
                                'address' => $address,
                                'phone' => $phone,
                                'birth' => $birth,
                                'level' => $level,
                                'restore' => 1,
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

    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect(URL . 'users/login');
    }

    public function clickDelete()
    {
        $id = $_GET['id'];
        $query = $this->Users->query();
        $query->update()
            ->set([
                'restore' => 0,
                'modified' => date('Y-m-d H:i:s')
            ])
            ->where(['id' => $id])
            ->execute();
        echo "ok";
        die;
    }

    public function delete()
    {
        $id = $_GET['id'];
        $query = $this->Users->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        echo "ok";
        die;
    }

    public function restore()
    {
        $id = $_GET['id'];
        $query = $this->Users->query();
        $query->update()
            ->set([
                'restore' => 1,
                'modified' => date('Y-m-d H:i:s')
            ])
            ->where(['id' => $id])
            ->execute();
        echo "ok";
        die;
    }

    public function addrestore()
    {
        $this->loadComponent('Auth');
        $HgNam = $this->Auth->user();
        $id = $_GET['id'];
        $data = $this->Users->find()
            ->where(['id' => $id]);
        foreach ($data as $value) { ?>
            <td><?php echo $value->id ?></td>
            <td><?php echo $value->email ?></td>
            <td><?php echo $value->fullname ?></td>
            <td><?php echo $value->address ?></td>
            <td><?php echo $value->phone ?></td>
            <td><?php echo $value->birth ?></td>
            <td><?php echo $value->level ?></td>
            <td><?php echo $value->secret_q ?></td>
            <td><?php echo $value->secret_a ?></td>
            <td><?php echo $value->created ?></td>
            <td><?php echo $value->modified ?></td>
            <?php if (($value->level == 'Member') || ($value->id == $HgNam[2])) { ?>
                <td>
                    <a href="<?php URL ?>users/edit/<?php echo $value->id ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" id="<?= $value->id ?>" class="btn btn-danger click">
                        <i class="far fa-trash-alt"></i> Delete
                    </button>
                </td>
            <?php } ?>
        <?php }
        die;
    }

    public function groupUsers()
    {
        $id = $_GET['id'];
        $data = $this->Groups->find('all')
            ->select([
                'Groups.name',
            ])->where(['Groups.restore' => 1 , 'Users.id' => $id])
            ->join([
                'table' => 'details',
                'alias' => 'Details',
                'type' => 'INNER',
                'conditions' => 'Groups.id = Details.group_id'
            ])->join([
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'INNER',
                'conditions' => 'Details.user_id = Users.id'
            ]);
        foreach ($data as $key => $value) { ?>
            <table border="1" style="width: 400px;margin: auto">
                <tr style="height: 45px;">
                    <th style="width: 50px;"><?= $key + 1 ?></th>
                    <th><?= $value->name ?></th>
                </tr>
            </table>
        <?php } die;
    }
}
