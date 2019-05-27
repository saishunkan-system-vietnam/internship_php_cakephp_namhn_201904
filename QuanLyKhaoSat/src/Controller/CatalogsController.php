<?php

namespace App\Controller;

use Cake\Event\Event;

class CatalogsController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Surveys');
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
            $data = $this->Catalogs->find()
                ->where(['restore' => 1]);
            $data = $this->paginate($data);
            $this->set("data", $data);
            $this->set("HgNam", $HgNam);
            $recycleBin = $this->Catalogs->find()
                ->where(['restore' => 0])->toArray();
            $this->set("recycleBin", $recycleBin);
            $dem = $this->Catalogs->find()
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
            $error = $this->Catalogs->find()
                ->where(['name' => $name])
                ->first();
            $result = array($name);
            if (isset($error->name)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Catalogs->query();
                $query->insert(['name', 'restore', 'created', 'modified'])
                    ->values([
                        'name' => $name,
                        'restore' => 1,
                        'created' => date('Y-m-d H:i:s'),
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->execute();

                return $this->redirect(URL . 'catalogs');
            }
        }

    }

    public function edit($id = null)
    {
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        $data = $this->Catalogs->find()
            ->where(['id' => $id])
            ->first();
        $this->set("data", $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = htmlentities($this->request->getData('name'));
            $error = $this->Catalogs->find()
                ->where(['name' => $name])
                ->first();
            if (isset($error->name) && $error->id != $data->id) {
                $this->set("error", $error);
                $this->set("name", $name);
            } else {
                $query = $this->Catalogs->query();
                $query->update()
                    ->set([
                        'name' => $name,
                        'modified' => date('Y-m-d H:i:s')
                    ])
                    ->where(['id' => $id])
                    ->execute();
                return $this->redirect(URL . 'Catalogs');
            }
        }

    }


    public function lists($id = null)
    {
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        $data = $this->Catalogs->find()
            ->where(['id' => $id])
            ->first();
        $this->set('data', $data);
        $survey = $this->Surveys->find()
            ->where(['catalog_id' => $data->id,
                'admin_create' => $HgNam[0]]);
        $this->set('survey', $survey);
    }

    public function clickDelete()
    {
        $id = $_GET['id'];
        $query = $this->Catalogs->query();
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
        $query = $this->Catalogs->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        echo "ok";
        die;
    }

    public function restore()
    {
        $id = $_GET['id'];
        $query = $this->Catalogs->query();
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
}
