<?php

namespace App\Controller;

use Cake\Event\Event;

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
                'name',
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
        $this->set("data", $this->paginate($details));
    }

    public function add()
    {
        $catalog = $this->Catalogs->find()
            ->select(['id', 'name']);
        $this->set("catalog", $catalog);
        if ($this->request->is('post')) {
            $name = $this->request->getData('name');
            $error = $this->Surveys->find()
                ->where(["name" => $name])
                ->first();
            $catalog_id = htmlentities($this->request->getData('catalog_id'));
            $start_time = htmlentities($this->request->getData('start_time'));
            $end_time = htmlentities($this->request->getData('end_time'));
            $login_status = htmlentities($this->request->getData('login_status'));
            $maximum = htmlentities($this->request->getData('maximum'));
            $result = array($name, $catalog_id, $start_time, $end_time, $login_status, $maximum);
            if (isset($error->name)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Surveys->query();
                $query->insert(['name', 'catalog_id', 'start_time', 'end_time', 'login_status', 'maximum', 'created', 'modified'])
                    ->values([
                        'name' => $name,
                        'catalog_id' => $catalog_id,
                        'start_time' => $start_time,
                        'end_time' => $end_time,
                        'login_status' => $login_status,
                        'maximum' => $maximum,
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
            $name = $this->request->getData('name');
            $error = $this->Surveys->find()
                ->where(['name' => $name])
                ->first();
            $catalog_id = htmlentities($this->request->getData('catalog_id'));
            $start_time = htmlentities($this->request->getData('start_time'));
            $end_time = htmlentities($this->request->getData('end_time'));
            $login_status = htmlentities($this->request->getData('login_status'));
            $maximum = htmlentities($this->request->getData('maximum'));
            $result = array($name, $catalog_id, $start_time, $end_time, $login_status, $maximum);
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
        //== Lấy Số Người Chọn Đáp Án Checkbox - Radio - Select
        
        //=====================================================
    }
}
