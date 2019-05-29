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
        $catalog = $this->Catalogs->find();
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
            ->where(['status' => 'open'])->limit(5)->offset($dem-5);
        $this->set('dataNew',$dataNew);
    }

    public function catalog($id = null)
    {
        $this->viewBuilder()->setLayout('action');
        $catalog = $this->Catalogs->find();
        $this->set('catalog', $catalog);
        //================================
        $catalogID = $this->Catalogs->find()->where(['id' => $id])->first();
        $this->set('catalogID', $catalogID);
        //====== Khảo Sát Công Khai =======
        $dataOff = $this->Surveys->find()
            ->where(['login_status' => '', 'catalog_id' => $id]);
        $this->set('dataOff', $dataOff);
        //====== Khảo Sát Công Khai =======
        $dataOn = $this->Surveys->find()
            ->where(['login_status' => 'on', 'catalog_id' => $id]);
        $this->set('dataOn', $dataOn);
        //===============================================
        $this->loadComponent('Auth');
        if (empty($this->Auth->user())) {
            Cache::write('link', 'actions/catalog/' . $catalogID->id);
        }
        $HgNam = ($this->Auth->user());
        $this->set('HgNam', $HgNam);
        Cache::write('linkRegist', URL . 'actions/login');
        $dem = $this->Surveys->find()->count();
        $dataNew = $this->Surveys->find()
            ->where(['status' => 'open'])->limit(5)->offset($dem-5);
        $this->set('dataNew',$dataNew);
    }

    public function survey($id = null)
    {
        $link = $this->Cookie->read('link');
//        if (!empty($link)) {
//            $this->set('link',$link);
//        }
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
        //=====================================
        // Lấy dữ liệu trả lời Khảo Sát
        if ($this->request->is('post')) {
            // Lấy Thằng Đã Khảo Sát
            $this->loadComponent('Auth');
            $HgNam = $this->Auth->user();
            $flgU = 0;
            foreach ($dataQuestion as $value) {
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
                            break;
                        }else {
                            $answers = $this->request->getData('answers' . $value->id);
                            $answers = implode(",", $answers);
                            $answers = htmlentities($answers);
                        }
                    } else {
                        $answers = '';
                    }
                } elseif ($value->type_answer == 'Images') {
                    $answers = $this->request->getData('answers' . $value->id)['name'];
                    move_uploaded_file($_FILES['answers' . $value->id]["tmp_name"], WWW_ROOT . 'img/answer' . DS . $answers);
                } else {
                    $answers = htmlentities($this->request->getData('answers' . $value->id));
                    $answers = str_replace(",", ";", $answers);
                }
                $query = $this->Statists->query();
                $query->insert(['answer', 'type_answer', 'survey_id', 'question_id', 'user_answer', 'created_at'])
                    ->values([
                        'answer' => isset($answers) ? $answers : '',
                        'type_answer' => $value->type_answer,
                        'survey_id' => $value->survey_id,
                        'question_id' => $value->id,
                        'user_answer' => isset($HgNam[3]) ? $HgNam[3] : '',
                        'created_at' => date('Y-m-d H:i:s'),
                    ])
                    ->execute();
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
            ->where(['name LIKE' => $key . '%'])
            ->limit(4)
            ->toArray();
        $this->set('dataKey', $data);
        foreach ($data as $valueKey) { ?>
            <style>
                .sugges {
                    z-index: 2;
                    position: relative;
                    margin-left: 24px;
                }

                .sugges tr {
                    height: 40px;
                }

                .sugges tr button {
                    width: 350px;
                    background-color: white;
                    border: none;
                    text-align: left;
                    color: black;
                }

                .sugges tr button:hover {
                    background-color: #DDDDDD;
                }

                .sugges tr button i {
                    color: black;
                    margin-left: 30px;
                }

                .sugges tr button a {
                    color: black;
                    text-decoration: none;
                }
            </style>
            <table class="sugges">
                <tr>
                    <th>
                        <button class="H form-control" id="H<?= $valueKey->id ?>"><?= $valueKey->name ?></button>
                    </th>
                </tr>
            </table>
        <?php }
        die;
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('action');
        $catalog = $this->Catalogs->find();
        $this->set('catalog', $catalog);
        //=============================================
        $this->loadComponent('Auth');
        $HgNam = ($this->Auth->user());
        $this->set('HgNam', $HgNam);
        //=============================================
    }

    public function checklogin()
    {
        $this->loadComponent('Auth');
        $email = isset($_GET['email']) ? $_GET['email'] : "";
        $password = isset($_GET['password']) ? $_GET['password'] : "";
        $data = $this->Users->find()
            ->select(['email', 'password', 'id', 'level', 'fullname'])
            ->where(['email' => $email])
            ->first();
        if (isset($data->email)) {
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

//    public function regists()
//    {
//        $this->viewBuilder()->setLayout('action');
//        $catalog = $this->Catalogs->find();
//        $this->set('catalog', $catalog);
//        //=============================================
//        $this->loadComponent('Auth');
//        $HgNam = ($this->Auth->user());
//        $this->set('HgNam', $HgNam);
//    }

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
            $secret_q = htmlentities($this->request->getData('secret_q'));
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
}

?>