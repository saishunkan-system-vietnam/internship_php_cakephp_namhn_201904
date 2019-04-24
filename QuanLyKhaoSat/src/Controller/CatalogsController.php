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
                $query->insert(['name', 'created'])
                    ->values([
                        'name' => $name,
                        'created' => $created
                    ])
                    ->execute();

                return $this->redirect(SITE_URL . 'catalogs');
            }
        }

    }

    public function edit($id = null)
    {
        $data = $this->Catalogs->find()
            ->where(['id' => $id])
            ->first();
        $this->set("data", $data);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $this->request->getData('name');
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
                    ])
                    ->where(['id' => $id])
                    ->execute();
                return $this->redirect(SITE_URL . 'Catalogs');
            }
        }

    }

    public function delete($id = null)
    {
        $query = $this->Catalogs->query();
        $query->delete()
            ->where(['id' => $id])
            ->execute();
        return $this->redirect(SITE_URL . 'Catalogs');
    }

    public function listsurveys($id = null)
    {
        $data= $this->Catalogs->find()
                ->where(['id' => $id])
                ->first();
        $this->set('data',$data);
        $survey = $this->Surveys->find()
            ->where(['catalog_id' => $data->id]);
        $this->set('survey',$survey);
    }
}
