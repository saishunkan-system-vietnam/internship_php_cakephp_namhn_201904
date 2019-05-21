<?php

namespace App\Controller;

class HomesController extends AppController
{
    public function index(){
        $HgNam = ($this->Auth->user());
        $this->set("HgNam", $HgNam);
    }
}