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
        $this->loadModel('Questions');
        $this->loadModel('Statists');
        $this->loadModel('Surveys');
    }


    public function index()
    {
        $details = $this->Surveys->find('all')
            ->select([
                'id',
                'img_survey',
                'hot',
                'name',
                'status',
                'Catalogs.name',
                'start_time',
                'end_time',
                'login_status',
                'maximum',
                'count',
                'created',
                'modified'
            ])
            ->join([
                'table' => 'catalogs',
                'alias' => 'Catalogs',
                'type' => 'INNER',
                'conditions' => 'Surveys.catalog_id = Catalogs.id'
            ]);
        $this->paginate = array(
            'limit' => 4,
            'order' => array('id' => 'asc'),
        );
        $this->set("data", $this->paginate($details));
    }

    public function add()
    {
        $catalog = $this->Catalogs->find()
            ->select(['id', 'name']);
        $this->set("catalog", $catalog);
        if ($this->request->is('post')) {
            $name = htmlentities($this->request->getData('name'));
            $img = $this->request->getData('img')['name'];
            move_uploaded_file($_FILES["img"]["tmp_name"], WWW_ROOT . 'img/survey' . DS . $img);
            $error = $this->Surveys->find()
                ->where(["name" => $name])
                ->first();
            $catalog_id = htmlentities($this->request->getData('catalog_id'));
            $start_time = htmlentities($this->request->getData('start_time'));
            $end_time = htmlentities($this->request->getData('end_time'));
            $login_status = htmlentities($this->request->getData('login_status'));
            $maximum = htmlentities($this->request->getData('maximum'));
            $status = htmlentities($this->request->getData('status'));
            $hot = htmlentities($this->request->getData('hot'));
            $result = array($name, $catalog_id, $start_time, $end_time, $login_status, $maximum,$hot);
            if (isset($error->name)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Surveys->query();
                $query->insert(['name', 'img_survey','hot' ,'catalog_id', 'start_time', 'end_time', 'login_status', 'maximum', 'status', 'created', 'modified'])
                    ->values([
                        'name' => $name,
                        'img_survey' => $img,
                        'catalog_id' => $catalog_id,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'login_status' => $login_status,
                        'maximum' => $maximum,
                        'status' => $status,
                        'hot' => $hot,
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->execute();
                return $this->redirect(URL . 'Surveys');
            }
        }

    }

    public function edit($id = null)
    {
        $data = $this->Surveys->find()
            ->where(['id' => $id])
            ->first();
        $this->set("data", $data);
        // Lấy tên danh mục khảo sát
        $catalog = $this->Catalogs->find()
            ->where(['id' => $data->catalog_id])
            ->first();
        $this->set("catalog", $catalog);
        //==============================
        // Lấy tên danh mục khảo sát khác
        $select = $this->Catalogs->find()
            ->where(['id !=' => $data->catalog_id]);
        $this->set("select", $select);
        //==================================
        $data2 = $this->Questions->find()
            ->where(['survey_id' => $id]);
        $this->set("data2", $data2);
        if ($this->request->is('post')) {
            $name = htmlentities($this->request->getData('name'));
            // Ảnh
            $img = $this->request->getData('img')['name'];
            if ($img != '') {
                @unlink(WWW_ROOT . "img" . DS . $data->name);
                move_uploaded_file($_FILES["img"]["tmp_name"], WWW_ROOT . 'img/survey' . DS . $img);
                $query = $this->Surveys->query();
                $query->update()
                    ->set([
                        'img_survey' => $img,
                    ])
                    ->where(['id' => $id])
                    ->execute();
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
            $result = array($name, $catalog_id, $start_time, $end_time, $login_status, $maximum,$hot);
            if (isset($error->name) && $error->id != $data->id) {
                $this->set("error", $error);
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

    public function delete($id = null)
    {
        $survey = $this->Surveys->find()->where(['id' => $id])->first();
        unlink(WWW_ROOT . "img/survey" . DS . $survey->img_survey);
        $query = $this->Surveys->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        return $this->redirect(URL . 'Surveys');
    }


    public function view($id = null)
    {
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
        $conn = ConnectionManager::get('default');
        $data = $conn->execute("SELECT * FROM statists WHERE question_id = $quest_id HAVING answer LIKE '%$answer%'")->fetchAll('obj');
        foreach ($data as $value) {
            $dataUsers = $value->user_answer;
            echo($dataUsers);
            echo "<br>";
        }
    }

    public function statist($id = null)
    {
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
            'Questions.name',
            'Questions.type_question',
            'Questions.answers',
            'answer' => 'group_concat(answer)',
            'user_answer' => 'group_concat(user_answer)',
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
}
