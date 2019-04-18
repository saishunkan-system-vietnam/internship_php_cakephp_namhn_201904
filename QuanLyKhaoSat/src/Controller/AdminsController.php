<?php

namespace App\Controller;

use App\Controller\AppController;


class AdminsController extends AppController
{
    var $name = "Users";
    var $helpers = array("Html");
    var $component = array("Session");
    var $_sessionUsername = "Username"; // tên Session được qui định trước

    public function view()
    {
        if (!$this->Session->read($this->_sessionUsername)) // đọc Session xem có tồn tại không
            $this->redirect("login");
        else
            $this->render("/admin/index"); // load 1 file view index.ctp trong thư mục “views/demos/users”/
    }

    public function login()
    {
        $error = "";
        if ($this->Session->read("Email"))
            $this->redirect("view");

        if (isset($_POST['ok'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($this->User->checkLogin($username, $password)) {
                $this->Session->write($this->_sessionUsername, $username);
                $this->redirect("view");
            } else {
                $error = "Username or Password wrong";
            }
        }
        $this->set("error", $error);
        $this->render("/demos/users/login");
    }

    public function logout()
    {
        $this->Session->delete($this->_sessionUsername);
        $this->redirect("login");
    }
}