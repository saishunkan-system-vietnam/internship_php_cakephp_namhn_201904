<?php

namespace App\Controller;

use Cake\Event\Event;

use Cake\Cache\Cache;
use Cake\Mailer\Email;


class ActionsController extends AppController
{
    public function initialize()
    {
        $this->loadComponent("Cookie");
//        parent::initialize();
//        $this->loadComponent('Paginator');

    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Users');
        $this->loadModel('Groups');
        $this->loadModel('Catalogs');
        $this->loadModel('Surveys');
        $this->loadModel('Questions');
        $this->loadModel('Statists');
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('action');
        $this->loadComponent('Auth');
        if (empty($this->Auth->user())) {
            Cache::write('link', 'actions');
        }
        $HgNam = ($this->Auth->user());
        $this->set('HgNam', $HgNam);
        //====== Danh mục Khảo Sát ========
        $catalog = $this->Catalogs->find()->limit(8);
        $this->set('catalog', $catalog);
        //=================================
        $surveyOff = $this->Surveys->find()
            ->where(['login_status' => '', 'hot' => 1]);
        $this->set('SurveyOff', $surveyOff);
        //=================================
        $surveyHot = $this->Surveys->find()
            ->where(['hot' => 1]);
        $this->set('SurveyHot', $surveyHot);
        Cache::write('linkRegist', URL . 'actions/login');
        //==========Lấy 5 Khảo Sát Công Khai Mới Nhất========
        $dem = $this->Surveys->find()->count();
        $dataNew = $this->Surveys->find()
            ->where(['status' => 'open', 'login_status' => ''])->limit(5)->offset($dem - 5);
        $this->set('dataNew', $dataNew);
    }

    public function catalog($id = null)
    {
        $this->viewBuilder()->setLayout('action');
        $catalog = $this->Catalogs->find()->limit(8);
        $this->set('catalog', $catalog);
        //================================
        $catalogID = $this->Catalogs->find()->where(['id' => $id])->first();
        $this->set('catalogID', $catalogID);
        //====== Khảo Sát Công Khai =======
        $dataOff = $this->Surveys->find()
            ->where(['login_status' => '', 'catalog_id' => $id])->toArray();
        $this->set('dataOff', $dataOff);
        //====== Khảo Sát Công Khai =======
        $dataOn = $this->Surveys->find()
            ->where(['login_status' => 'on', 'catalog_id' => $id])->toArray();
        $this->set('dataOn', $dataOn);
        //===============================================
        $this->loadComponent('Auth');
        if (empty($this->Auth->user())) {
            if (isset($catalogID->id)) {
                Cache::write('link', 'actions/catalog/' . $catalogID->id);
            }
        }
        $HgNam = ($this->Auth->user());
        $this->set('HgNam', $HgNam);
        Cache::write('linkRegist', URL . 'actions/login');
        $dem = $this->Surveys->find()->count();
        $dataNew = $this->Surveys->find()
            ->where(['status' => 'open', 'login_status' => ''])->limit(6)->offset($dem - 6);
        $this->set('dataNew', $dataNew);
    }

    public function survey($id = null)
    {
        $link = $this->Cookie->read('link');
//        if (!empty($link)) {
//            $this->set('link',$link);
//        }
        $this->loadComponent('Auth');
        $HgNam = $this->Auth->user();
        $this->viewBuilder()->setLayout('survey');
        // Lấy database của Survey có id = $id
        $dataSurvey = $this->Surveys->find()
            ->where(['id' => $id])
            ->first();
        $this->set('dataSurvey', $dataSurvey);
        //=======================================
        // Lấy Question của Survey có id = $id
        $dataQuestion = $this->Questions->find()
            ->where(['survey_id' => $id])->toArray();
        $this->set('dataQuestion', $dataQuestion);
        $this->set('id', $id);
        //======== Lấy danh sách người được khảo sát ============
        $detailUsers = $this->Surveys->find()
            ->select([
                'Users.id',
            ])->where(['Users.restore' => 1, 'Surveys.id' => $id])
            ->join([
                'table' => 'User_survey',
                'alias' => 'User_survey',
                'type' => 'INNER',
                'conditions' => 'Surveys.id = User_survey.survey_id',
            ])->join([
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'INNER',
                'conditions' => 'Users.id = User_survey.user_id',
            ])->toArray();
        //=======================================================
        //======== Lấy danh sách nhóm được khảo sát ============
        $detailGroup = $this->Groups->find()
            ->select([
                'Users.id',
            ])->where(['Groups.restore' => 1, 'Surveys.id' => $id])
            ->join([
                'table' => 'group_s',
                'alias' => 'Group_s',
                'type' => 'INNER',
                'conditions' => 'Groups.id = Group_s.group_id',
            ])->join([
                'table' => 'surveys',
                'alias' => 'Surveys',
                'type' => 'INNER',
                'conditions' => 'Surveys.id = Group_s.survey_id',
            ])->join([
                'table' => 'details',
                'alias' => 'Details',
                'type' => 'INNER',
                'conditions' => 'Groups.id = Details.group_id'
            ])->join([
                'table' => 'users',
                'alias' => 'Users',
                'type' => 'INNER',
                'conditions' => 'Users.id = Details.user_id'
            ])
            ->toArray();
        $result = array_merge($detailUsers, $detailGroup);
        // Đây là Kết Quả những người được phép tham gia khảo sát này
        $result = array_unique($result);
        if (isset($dataSurvey) && $dataSurvey->status != "closed") {
            if (!empty($result)) {
                foreach ($result as $value) {
                    if ($value["Users"]["id"] == $HgNam[2]) {
                        $this->set("success", true);
                    }
                }
            } else {
                $this->set("success", true);
            }
        } else {
            $this->set("success", true);
        }
        //=======================================================
        // Lấy dữ liệu trả lời Khảo Sát
        if ($this->request->is('post')) {
            // Lấy Thằng Đã Khảo Sát
            $this->loadComponent('Auth');
            $HgNam = $this->Auth->user();
            $flgU = 0;
            foreach ($dataQuestion as $value) {
                $checkSubmit = true;
                if ($value->type_answer == 'Checkbox') {
                    $answers = $this->request->getData('answers' . $value->id);
                    if (isset($answers)) {
                        $dataId = $this->Questions->find()
                            ->where(['id' => $value->id])->first();
                        $T = explode(",", $dataId->answers);
                        $answers = implode(",", $answers);
                        $answers = htmlentities($answers);
                        $answers = $answers . ',' . $dataId->answers;
                        $answers = explode(",", $answers);
                        $answers = array_unique($answers);
                        $result = array_diff($answers, $T);
                        if (!empty($result) != '') {
                            $this->set('resultError', $result);
                            $flgU = 1;
                            $checkSubmit = false;
                            break;
                        } else {
                            $answers = $this->request->getData('answers' . $value->id);
                            $answers = implode(",", $answers);
                            $answers = htmlentities($answers);
                        }
                    } else {
                        $answers = '';
                    }
                } elseif ($value->type_answer == 'Radio' || $value->type_answer == 'Select') {
                    $answers = $this->request->getData('answers' . $value->id);
                    if (isset($answers)) {
                        $dataId = $this->Questions->find()
                            ->where(['id' => $value->id])->first();
                        $T = explode(",", $dataId->answers);
                        $answers = htmlentities($answers);
                        $answers = $answers . ',' . $dataId->answers;
                        $answers = explode(",", $answers);
                        $answers = array_unique($answers);
                        $result = array_diff($answers, $T);
                        if (!empty($result) != '') {
                            $this->set('resultError', $result);
                            $flgU = 1;
                            $checkSubmit = false;
                            break;
                        } else {
                            $answers = $this->request->getData('answers' . $value->id);
                            $answers = htmlentities($answers);
                        }
                    } else {
                        $answers = '';
                    }
                } elseif ($value->type_answer == 'Images') {
                    $answers = $this->request->getData('answers' . $value->id)['name'];
                    $url_file = $_FILES["answers" . $value->id]["tmp_name"];
                    $checkImages = mime_content_type($url_file);
                    $checkImages = explode('/', $checkImages);
                    if ($checkImages[1] == 'jpeg' || $checkImages[1] == 'png') {
                        move_uploaded_file($_FILES['answers' . $value->id]["tmp_name"], WWW_ROOT . 'img/answer' . DS . $answers);
                    } else {
                        $this->set('ErrorImg', "ErrorImg");
                        $flgU = 1;
                        $checkSubmit = false;
                        break;
                    }
                } else {
                    $answers = htmlentities($this->request->getData('answers' . $value->id));
                    $answers = str_replace(",", ";", $answers);
                }
                if ($checkSubmit == true) {
                    $query = $this->Statists->query();
                    $query->insert(['answer', 'type_answer', 'survey_id', 'dem', 'question_id', 'user_answer', 'created_at'])
                        ->values([
                            'answer' => isset($answers) ? $answers : '',
                            'type_answer' => $value->type_answer,
                            'survey_id' => $value->survey_id,
                            'question_id' => $value->id,
                            'user_answer' => isset($HgNam[3]) ? $HgNam[3] : '',
                            'dem' => $dataSurvey->count + 1,
                            'created_at' => date('Y-m-d H:i:s'),
                        ])
                        ->execute();
                }
            }
            if ($flgU == 0) {
                $query = $this->Surveys->query();
                $query->update()
                    ->set([
                        'count' => $dataSurvey->count + 1,
                    ])
                    ->where(['id' => $id])
                    ->execute();
                $this->Cookie->write('link', 'actions/survey/' . $dataSurvey->id);
                return $this->redirect(URL . 'actions/survey/' . $dataSurvey->id);
            }
        }
        //=====================================
    }

    public function search()
    {
        $search = $_GET['search'];
        $search = htmlentities($search);
        $Catalog = $this->Catalogs->find()
            ->where(['name' => $search])->first();
        if (!empty($Catalog)) {
            $id = $Catalog['id'];
            echo $id;
            die;
        }
    }

    public function key()
    {
        $key = isset($_GET['key']) ? $_GET['key'] : "";
        $key = htmlentities($key);
        $data = $this->Catalogs->find()
            ->select(['name', 'id'])
            ->where(['name LIKE' => '%' . $key . '%'])
            ->limit(10)
            ->toArray();
        $this->set('dataKey', $data);
        foreach ($data as $key => $valueKey) { ?>
            <style>
                .sugges {
                    z-index: 2;
                    position: relative;
                    margin-left: 32px;
                }

                .sugges tr button {
                    width: 350px;
                    text-align: left;
                    color: black;
                    border-radius: 1px;
                }

                .sugges tr button a {
                    color: black;
                    text-decoration: none;
                }
            </style>
            <table class="sugges">
                <tr>
                    <th>
                        <button style="border-radius: 1px;" class="H form-control"
                                id="H<?= $valueKey->id ?>"><?= $valueKey->name ?></button>
                    </th>
                </tr>
            </table>
        <?php }
        die;
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('action');
        $this->loadComponent('Auth');
        $HgNam = ($this->Auth->user());
        $this->set('HgNam', $HgNam);
        $dem = $this->Surveys->find()->count();
        $dataNew = $this->Surveys->find()
            ->where(['status' => 'open', 'login_status' => ''])->limit(6)->offset($dem - 6);
        $this->set('dataNew', $dataNew);
        if (isset($HgNam)) {
            return $this->redirect(URL . 'actions');
        } else {
            $catalog = $this->Catalogs->find();
            $this->set('catalog', $catalog);
            //=============================================
        }
        //=============================================
    }

    public function checklogin()
    {
        $this->loadComponent('Auth');
        $email = isset($_GET['email']) ? $_GET['email'] : "";
        $password = isset($_GET['password']) ? $_GET['password'] : "";
        $data = $this->Users->find()
            ->select(['email', 'password', 'id', 'level', 'fullname', 'restore'])
            ->where(['email' => $email])
            ->first();
        if (isset($data->email) && $data->restore == '1') {
            $level = $data->level;
            $id = $data->id;
            $name = $data->fullname;
            $user = array($email, $level, $id, $name);
            $password = md5($password);
            if ($password == $data->password) {
                $this->Auth->setUser($user);
                echo('success');
                die();
            } else {
                echo('error');
                die();
            }
        } else {
            echo('error');
            die();
        }
    }

    public function logout()
    {
        $this->loadComponent('Auth');
        $this->Auth->logout();
        return $this->redirect(URL . 'actions');
    }

    public function forgotpass()
    {
        $this->viewBuilder()->setLayout('action');
        $catalog = $this->Catalogs->find();
        $this->set('catalog', $catalog);
        //=============================================
        $this->loadComponent('Auth');
        $HgNam = ($this->Auth->user());
        $this->set('HgNam', $HgNam);
        //===========================================
        if ($this->request->is('post')) {
            $users = $this->request->getData('email');
            $secret_q = $this->request->getData('secret_q');
            $secret_a = htmlentities($this->request->getData('secret_a'));
            $forgot = $this->Users->find()
                ->where(['email' => $users])->first();
            if (!empty($forgot) && $secret_q == $forgot->secret_q && $secret_a == $forgot->secret_a) {
                $email = new Email('default');
                $email->setFrom(['HoagNgNam@gmail.com' => 'Nam HN'])
                    ->setTo($users)
                    ->setSubject('Lấy Lại Mật Khẩu')
                    ->send('Mời Bạn Click đường link để lấy lại mật khẩu : ' . URL . 'actions/updatepass/' . $users);
                $success = "success";
                $this->set('success', $success);
                $query = $this->Users->query();
                $query->update()
                    ->set([
                        'token' => md5(date('Y-m-d H:i:s')),
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->where(['email' => $users])
                    ->execute();
            } else {
                $error = "error";
                $this->set('error', $error);
            }
        }
    }

    public function updatepass($email = null)
    {
        $check = $this->Users->find()
            ->where(['email' => $email])->first();
        $this->set('check', $check);
        $this->viewBuilder()->setLayout('action');
        $catalog = $this->Catalogs->find();
        $this->set('catalog', $catalog);
        //=============================================
        $this->loadComponent('Auth');
        $HgNam = ($this->Auth->user());
        $this->set('HgNam', $HgNam);
        //===========================================
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
                $query = $this->Users->query();
                $query->update()
                    ->set([
                        'token' => null,
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->where(['email' => $email])
                    ->execute();
                return $this->redirect(URL . "actions/success");
            } else {
                $password_error = "password_error";
                $this->set('passwrod_error', $password_error);
            }
        }
    }

    public function success()
    {
        $this->viewBuilder()->setLayout('action');
        $catalog = $this->Catalogs->find();
        $this->set('catalog', $catalog);
        //=============================================
        $this->loadComponent('Auth');
        $HgNam = ($this->Auth->user());
        $this->set('HgNam', $HgNam);
        //===========================================
    }

    public function info($id = null)
    {
        $this->viewBuilder()->setLayout('action');
        $catalog = $this->Catalogs->find()->limit(8);
        $this->set('catalog', $catalog);
        $dem = $this->Surveys->find()->count();
        $dataNew = $this->Surveys->find()
            ->where(['status' => 'open', 'login_status' => ''])->limit(5)->offset($dem - 5);
        $this->set('dataNew', $dataNew);
        $this->loadComponent('Auth');
        $HgNam = ($this->Auth->user());
        $this->set('HgNam', $HgNam);
        //== Lấy Infor ====================
        $info = $this->Users->find()->where(['id' => $id])->first();
        $this->set('info', $info);
    }

    public function infoedit($id = null)
    {
        $this->viewBuilder()->setLayout('action');
        $catalog = $this->Catalogs->find()->limit(8);
        $this->set('catalog', $catalog);
        $dem = $this->Surveys->find()->count();
        $dataNew = $this->Surveys->find()
            ->where(['status' => 'open', 'login_status' => ''])->limit(5)->offset($dem - 5);
        $this->set('dataNew', $dataNew);
        $this->loadComponent('Auth');
        $HgNam = ($this->Auth->user());
        $this->set('HgNam', $HgNam);
        //== Lấy Infor ====================
        $info = $this->Users->find()->where(['id' => $id])->first();
        $this->set('info', $info);
        if ($this->request->is('post')) {
            $fullname = htmlentities($this->request->getData('fullname'));
            $address = htmlentities($this->request->getData('address'));
            $phone = htmlentities($this->request->getData('phone'));
            $birth = htmlentities($this->request->getData('birth'));
            $secret_q = $this->request->getData('secret_q');
            $secret_a = htmlentities($this->request->getData('secret_a'));
            $password = htmlentities($this->request->getData('password'));
            if ($password != '') {
                $password = md5($password);
                $query = $this->Users->query();
                $query->update()
                    ->set([
                        'password' => $password,
                    ])
                    ->where(['id' => $id])
                    ->execute();
            }
            $query = $this->Users->query();
            $query->update()
                ->set([
                    'fullname' => $fullname,
                    'address' => $address,
                    'phone' => $phone,
                    'birth' => $birth,
                    'secret_q' => $secret_q,
                    'secret_a' => $secret_a,
                    'modified' => date('Y-m-d H:i:s')
                ])
                ->where(['id' => $id])
                ->execute();
            return $this->redirect(URL . 'actions');
        }
    }
}

?>