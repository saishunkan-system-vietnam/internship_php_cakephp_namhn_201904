<?php

namespace App\Controller;

use Cake\Event\Event;

use Cake\Datasource\ConnectionManager;


class SurveysController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Catalogs');
        $this->loadModel('Group_s');
        $this->loadModel('User_survey');
        $this->loadModel('Users');
        $this->loadModel('Groups');
        $this->loadModel('Questions');
        $this->loadModel('Statists');
        $this->loadModel('Surveys');
    }


    public function index()
    {
        $HgNam = ($this->Auth->user());
        if ($HgNam[1] == "Member") {
            return $this->redirect(URL . "actions");
        } else {
            $details = $this->Surveys->find('all')
                ->select([
                    'id',
                    'img_survey',
                    'hot',
                    'name',
                    'admin_create',
                    'status',
                    'Catalogs.name',
                    'Catalogs.restore',
                    'start_time',
                    'end_time',
                    'login_status',
                    'maximum',
                    'count',
                    'created',
                    'modified'
                ])->where(['admin_create' => $HgNam[0], 'Surveys.restore' => 1])
                ->join([
                    'table' => 'catalogs',
                    'alias' => 'Catalogs',
                    'type' => 'LEFT',
                    'conditions' => 'Surveys.catalog_id = Catalogs.id'
                ]);
            $this->paginate = array(
                'limit' => 8,
                'order' => array('id' => 'asc'),
            );
            $this->set("data", $this->paginate($details));
            $this->set("HgNam", $HgNam);
            $recycleBin = $this->Surveys->find()
                ->where(['restore' => 0, 'admin_create' => $HgNam[0]])->toArray();
            $this->set("recycleBin", $recycleBin);
            $dem = $this->Surveys->find()
                ->where(['restore' => 1, 'admin_create' => $HgNam[0]])->count();
            $this->set("dem", $dem);
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $total = ceil($dem / 8);
            $this->set("page", $page);
            $this->set("total", $total);
        }
    }

    public function add($id = null)
    {
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        //================================
        $catalogID = $this->Catalogs->find()
            ->select(['id', 'name'])->where(['id' => $id])->first();
        $this->set("catalogID", $catalogID);
        //================================
        $catalog = $this->Catalogs->find()
            ->select(['id', 'name'])->where(['restore' => 1]);
        $this->set("catalog", $catalog);
        if ($this->request->is('post')) {
            $name = htmlentities($this->request->getData('name'));
            $img = $this->request->getData('img')['name'];
            $tmp_name = $this->request->getData('img')['tmp_name'];
            if (!empty($img)) {
                $url_file = $_FILES["img"]["tmp_name"];
                $checkImages = mime_content_type($url_file);
                $checkImages = explode('/', $checkImages);
            }
            $error = $this->Surveys->find()
                ->where(["name" => $name])
                ->first();
            $catalog_id = htmlentities($this->request->getData('catalog_id'));
            $start_time = htmlentities($this->request->getData('start_time'));
            $end_time = htmlentities($this->request->getData('end_time'));
            if ($this->request->getData('login_status') != null) {
                $login_status = $this->request->getData('login_status');
            } else {
                $login_status = '';
            }
            $maximum = htmlentities($this->request->getData('maximum'));
            $status = htmlentities($this->request->getData('status'));
            $hot = htmlentities($this->request->getData('hot'));
            $result = array($name, $catalog_id, $start_time, $end_time, $login_status, $maximum, $hot);
            if (isset($error->name)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else if (strtotime($end_time) < strtotime($start_time)) {
                $errorTime = "ErrorTime";
                $this->set("errorTime", $errorTime);
                $this->set("result", $result);
            } else if (!empty($img) && $checkImages[1] != 'jpeg' && $checkImages[1] != 'png') {
                $errorImages = "ErrorImages";
                $this->set("errorImages", $errorImages);
                $this->set("result", $result);
            } else {
                move_uploaded_file($_FILES["img"]["tmp_name"], WWW_ROOT . 'img/survey' . DS . $img);
                $query = $this->Surveys->query();
                $query->insert(['name', 'admin_create', 'restore', 'img_survey', 'hot', 'catalog_id', 'start_time', 'end_time', 'login_status', 'maximum', 'status', 'created', 'modified'])
                    ->values([
                        'name' => $name,
                        'admin_create' => $HgNam[0],
                        'img_survey' => $img,
                        'catalog_id' => isset($id) ? $id : $catalog_id,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'login_status' => $login_status,
                        'maximum' => $maximum,
                        'status' => $status,
                        'hot' => $hot,
                        'restore' => 1,
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->execute();
                if (isset($id)) {
                    return $this->redirect(URL . 'catalogs/lists/' . $id);
                } else {
                    return $this->redirect(URL . 'Surveys');
                }
            }
        }

    }

    public function test()
    {
        if ($this->request->is('post')) {
            $name = $this->request->getData('name');
            dd($name);
        }
    }

    public function edit($id = null)
    {
        $this->set('id', $id);
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        $data = $this->Surveys->find()
            ->where(['id' => $id])
            ->first();
        $this->set("data", $data);
        // Lấy tên danh mục khảo sát
        $catalog = $this->Catalogs->find()
            ->where(['id' => isset($data->catalog_id) ? $data->catalog_id : null, 'restore' => 1])
            ->first();
        $this->set("catalog", $catalog);
        //==============================
        // Lấy tên danh mục khảo sát khác
        $select = $this->Catalogs->find()
            ->where(['id !=' => isset($data->catalog_id) ? $data->catalog_id : null, 'restore' => 1]);
        $this->set("select", $select);
        //==================================
        $data2 = $this->Questions->find()
            ->where(['survey_id' => $id]);
        $this->set("data2", $data2);
        // danh sách nhóm đã được tham gia khảo sát
        $listGroup = $this->Surveys->find()
            ->select([
                'Group_s.id',
                'Group_s.survey_id',
                'Groups.id',
                'Groups.name',
            ])->where(['Groups.restore' => 1, 'Groups.admin_create' => $HgNam[2]])
            ->join([
                'table' => 'group_s',
                'alias' => 'Group_s',
                'type' => 'INNER',
                'conditions' => 'Surveys.id = Group_s.survey_id',
            ])->join([
                'table' => 'groups',
                'alias' => 'Groups',
                'type' => 'INNER',
                'conditions' => 'Groups.id = Group_s.group_id',
            ])->toArray();
        $this->set('listGroup', $listGroup);
        // danh sách users đã được tham gia khảo sát
        $listUser = $this->Surveys->find()
            ->select([
                'User_survey.id',
                'User_survey.survey_id',
                'Users.id',
                'Users.email',
            ])->where(['Users.restore' => 1, 'Surveys.id' => $id])
            ->join([
                'table' => 'User_survey',
                'alias' => 'User_survey',
                'type' => 'INNER',
                'conditions' => 'Surveys.id = User_survey.survey_id',
            ])
            ->join([
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'INNER',
                'conditions' => 'Users.id = User_survey.user_id',
            ])->toArray();
        $this->set('listUser', $listUser);
        // danh sách nhóm chưa được tham gia khảo sát
        $dataGroup = $this->Groups->find()
            ->where(['restore' => '1', 'admin_create' => $HgNam[2],
                'Groups.id NOT IN' => ($this->Group_s->find()->select(['group_id'])->where(['survey_id' => $id]))])
            ->toArray();
        $this->set('dataGroup', $dataGroup);
        $dataUser = $this->Users->find()
            ->where(['restore' => '1',
                'Users.id NOT IN' => ($this->User_survey->find()->select(['user_id'])->where(['survey_id' => $id]))])
            ->toArray();
        $this->set('dataUser', $dataUser);
        if ($this->request->is('post')) {
            $name = htmlentities($this->request->getData('name'));
            // Ảnh
            $img = $this->request->getData('img')['name'];
            if ($img != '') {
                $tmp_name = $this->request->getData('img')['tmp_name'];
                $checkImages = mime_content_type($tmp_name);
                $checkImages = explode('/', $checkImages);
                if ($checkImages[1] == 'jpeg' || $checkImages[1] == 'png') {
                    @unlink(WWW_ROOT . "img/survey" . DS . $data->img_survey);
                    move_uploaded_file($_FILES["img"]["tmp_name"], WWW_ROOT . 'img/survey' . DS . $img);
                    $query = $this->Surveys->query();
                    $query->update()
                        ->set([
                            'img_survey' => $img,
                        ])
                        ->where(['id' => $id])
                        ->execute();
                }
            }
            // End Ảnh
            $error = $this->Surveys->find()
                ->where(['name' => $name])
                ->first();
            $catalog_id = htmlentities($this->request->getData('catalog_id'));
            $start_time = htmlentities($this->request->getData('start_time'));
            $end_time = htmlentities($this->request->getData('end_time'));
            $login_status = htmlentities($this->request->getData('login_status'));
            $maximum = htmlentities($this->request->getData('maximum'));
            $status = htmlentities($this->request->getData('status'));
            $hot = htmlentities($this->request->getData('hot'));
            $result = array($name, $catalog_id, $start_time, $end_time, $login_status, $maximum, $hot);
            if (isset($error->name) && $error->id != $data->id) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else if (strtotime($end_time) < strtotime($start_time)) {
                $errorTime = "ErrorTime";
                $this->set("errorTime", $errorTime);
                $this->set("result", $result);
            } else if (isset($checkImages) && $checkImages[1] != 'jpeg' && $checkImages[1] != 'png') {
                $errorImages = "ErrorImages";
                $this->set("errorImages", $errorImages);
                $this->set("result", $result);
            } else {
                $query = $this->Surveys->query();
                $query->update()
                    ->set([
                        'name' => $name,
                        'catalog_id' => $catalog_id,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'login_status' => $login_status,
                        'maximum' => $maximum,
                        'status' => $status,
                        'hot' => $hot,
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->where(['id' => $id])
                    ->execute();
                return $this->redirect(URL . 'Surveys');
            }
        }

    }

    public function view($id = null)
    {
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        $dataS = $this->Surveys->find()
            ->where(['id' => $id])
            ->first();
        $this->set("dataS", $dataS);
        $data = $this->Questions->find()
            ->where(['survey_id' => $id]);
        $this->set("data", $data);
    }

    public function viewdetail()
    {
        $quest_id = $_GET['qid'];
        $answer = $_GET['asr'];
        $answer = htmlentities($answer);
        $conn = ConnectionManager::get('default');
        $data = $conn->execute("SELECT * FROM statists WHERE question_id = $quest_id HAVING answer LIKE '%$answer%'")->fetchAll('obj');
        foreach ($data as $value) {
            $dataUsers = $value->user_answer;?>
            <table class="table table-bordered">
                <tr>
                    <th style="width: 30%">Khảo Sát Lần <?= $value->dem; ?></th>
                    <th style="width: 30%"><?php echo $dataUsers; ?></th>
                    <th><?= $value->created_at; ?></th>
                </tr>
            </table>
            <?php
        }
        die;
    }

    public function statist($id = null)
    {
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        // Lấy tên Khảo Sát dựa theo ID khảo sát
        $dataS = $this->Surveys->find()
            ->where(['id' => $id])
            ->first();
        $this->set("dataS", $dataS);
        //======================================
        // Lấy danh sách câu hỏi thuộc khảo Sát
        $dataQ = $this->Questions->find()
            ->where(['survey_id' => $id]);
        $this->set("dataQ", $dataQ);
        //======================================
        //== Lấy dữ liệu để thống kê khảo sát ==
        //== Lấy dữ liệu dạng Text và TextArea
        $query = $this->Statists->find();
        $data = $query->select([
            'question_id',
            'survey_id',
            'Statists.dem',
            'Questions.name',
            'Questions.type_question',
            'Questions.answers',
            'answer' => 'group_concat(answer)',
            'user_answer' => 'group_concat(user_answer)',
            'dem2' => "group_concat(Statists.dem)",
            'type_answer'])->join([
            'table' => 'questions',
            'alias' => 'Questions',
            'type' => 'INNER',
            'conditions' => 'Statists.question_id = Questions.id',
        ])->group('question_id')->where(['Statists.survey_id' => $id])->toArray();
        $this->set("data", $data);
        //===========================================
        $conn = ConnectionManager::get('default');
        $this->set('conn', $conn);
    }

    public function clickDelete()
    {
        $id = $_GET['id'];
        $query = $this->Surveys->query();
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
        $survey = $this->Surveys->find()->where(['id' => $id])->first();
        unlink(WWW_ROOT . "img/survey" . DS . $survey->img_survey);
        $query = $this->Surveys->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        echo "ok";
        die;
    }

    public function restore()
    {
        $id = $_GET['id'];
        $query = $this->Surveys->query();
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

    public function formgroup()
    {
        if ($this->request->is('post')) {
            $id_group = $this->request->getData('group');
            $id = $this->request->getData('id');
            foreach ($id_group as $value) {
                $query = $this->Group_s->query();
                $query->insert(['survey_id', 'group_id'])
                    ->values([
                        'survey_id' => $id,
                        'group_id' => $value,
                    ])
                    ->execute();
            }
            return $this->redirect(URL . 'surveys/edit/' . $id);
        }
    }

    public function deletegroup()
    {
        $id = $_GET['id'];
        $query = $this->Group_s->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        echo "ok";
        die;
    }

    public function deleteuser()
    {
        $id = $_GET['id'];
        $query = $this->User_survey->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        echo "ok";
        die;
    }

    public function formuser()
    {
        if ($this->request->is('post')) {
            $id_user = $this->request->getData('user');
            $id = $this->request->getData('id');
            foreach ($id_user as $value) {
                $query = $this->User_survey->query();
                $query->insert(['survey_id', 'user_id'])
                    ->values([
                        'survey_id' => $id,
                        'user_id' => $value,
                    ])
                    ->execute();
            }
            return $this->redirect(URL . 'surveys/edit/' . $id);
        }
    }

}
