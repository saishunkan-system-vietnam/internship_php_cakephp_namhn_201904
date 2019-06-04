<?php

namespace App\Controller;

use Cake\Event\Event;

class GroupsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Users');
        $this->loadModel('Details');

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
            $data = $this->Groups->find()
                ->where(['restore' => 1, 'admin_create' => $HgNam[2]]);
            $data = $this->paginate($data);
            $this->set("data", $data);
            $this->set("HgNam", $HgNam);
            $recycleBin = $this->Groups->find()
                ->where(['restore' => 0])->toArray();
            $this->set("recycleBin", $recycleBin);
            $dem = $this->Groups->find()
                ->where(['restore' => 1])->count();
            $this->set("dem", $dem);
        }
    }

    public function add()
    {
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlentities($this->request->getData('name'));
            $error = $this->Groups->find()
                ->where(['name' => $name, 'admin_create' => $HgNam[2]])
                ->first();
            $result = array($name);
            if (isset($error->name)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Groups->query();
                $query->insert(['name', 'admin_create', 'restore', 'created', 'modified'])
                    ->values([
                        'name' => $name,
                        'admin_create' => $HgNam[2],
                        'restore' => 1,
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->execute();

                return $this->redirect(URL . 'Groups');
            }
        }

    }

    public function edit($id = null)
    {
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        $data = $this->Groups->find()
            ->where(['id' => $id])
            ->first();
        $this->set("data", $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlentities($this->request->getData('name'));
            $error = $this->Groups->find()
                ->where(['name' => $name])
                ->first();
            if (isset($error->name) && $error->id != $data->id) {
                $this->set("error", $error);
                $this->set("name", $name);
            } else {
                $query = $this->Groups->query();
                $query->update()
                    ->set([
                        'name' => $name,
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->where(['id' => $id])
                    ->execute();
                return $this->redirect(URL . 'Groups');
            }
        }

    }


    public function lists($id = null)
    {
        if ($this->request->is('post')) {
            $user_id = $this->request->getData('member');
            foreach ($user_id as $value) {
                $queryCheck = $this->Details->find()->where(['user_id' => $value, 'group_id' => $id])->toArray();
                if (empty($queryCheck)) {
                    $query = $this->Details->query();
                    $query->insert(['user_id', 'group_id'])
                        ->values([
                            'user_id' => $value,
                            'group_id' => $id,
                        ])
                        ->execute();
                }
            }
        }
        //=============================================================
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        $groups = $this->Groups->find()->where(['id' => $id])->first();
        $this->set('groups', $groups);
        $details = $this->Groups->find('all')
            ->select([
                'Details.id',
                'Groups.id',
                'Groups.name',
                'Users.email',
                'Users.fullname',
                'Users.level',
            ])->where(['Users.restore' => 1, 'Groups.id' => $id])
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
            ])->toArray();
        $this->set('data', $details);
        //====================== Them user vào group
        $dataQuery = $this->Users->find()
            ->where(['level' => 'Member',
                'Users.id NOT IN' => ($this->Details->find()->select(['user_id'])->where(['group_id' => $id]))])
            ->toArray();
        $this->set('dataQuery', $dataQuery);
    }

    public function clickDelete()
    {
        $id = $_GET['id'];
        $query = $this->Groups->query();
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
        $query = $this->Groups->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        echo "ok";
        die;
    }

    public function deletemember()
    {
        $id = $_GET['id'];
        $query = $this->Details->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        echo "ok";
        die;
    }

    public function restore()
    {
        $id = $_GET['id'];
        $query = $this->Groups->query();
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

    public function listmember()
    {
        $id = $_GET['id'];
        $data = $this->Users->find()
            ->where(['level' => 'Member',
                'Users.id NOT IN' => ($this->Details->find()->select(['user_id'])->where(['group_id' => $id]))])
            ->toArray();
        if (empty($data)) {
            echo "Bạn Chưa Tham GIa Nhóm Nào ";
            die;
        } else {
            foreach ($data as $key => $value) { ?>
                <table class="table table-hover table-bordered">
                    <tr>
                        <th><?= $key + 1 ?></th>
                        <th><?= $value->email ?></th>
                        <th><?= $value->fullname ?></th>
                        <th>
                            <label>
                                <input type="checkbox" name="member[<?= $value->id ?>]" value="<?= $value->id ?>"/>
                                <span></span>
                            </label>
                        </th>
                    </tr>
                </table>
            <?php }
        }
        die;
    }
}

?>
