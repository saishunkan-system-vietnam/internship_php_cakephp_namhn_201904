<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class Admin extends Table
{
    var $name = "User";

    function checkLogin($email, $password)
    {
        $sql = "Select email,password from users Where username='$email' AND password ='$password'";
        $this->query($sql);
        if ($this->getNumRows() == 0) {
            return false;
        } else {
            return true;
        }
    }
}