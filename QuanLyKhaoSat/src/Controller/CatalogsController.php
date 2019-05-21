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
        $this->paginate = array(
            'limit' => 4,
            'order' => array('id' => 'asc'),
        );
        $data = $this->paginate("Catalogs");
        $this->set("data", $data);
        $this->set("HgNam", $HgNam);
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
            $created = htmlentities($this->request->getData('created'));
            $result = array($name, $created);
            if (isset($error->name)) {
                $this->set("error", $error);
                $this->set("result", $result);
            } else {
                $query = $this->Catalogs->query();
                $query->insert(['name', 'created', 'modified'])
                    ->values([
                        'name' => $name,
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

    public function delete($id = null)
    {
        $query = $this->Catalogs->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        return $this->redirect(URL . 'Catalogs');
    }

    public function listsurveys($id = null)
    {
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
        $data = $this->Catalogs->find()
            ->where(['id' => $id])
            ->first();
        $this->set('data', $data);
        $survey = $this->Surveys->find()
            ->where(['catalog_id' => $data->id]);
        $this->set('survey', $survey);
    }
}
