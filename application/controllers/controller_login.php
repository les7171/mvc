<?php

class Controller_login extends Controller
{
    public function action_index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') $this->view->generate('login_view.php', "template_view.php");
        else 
        {
            $login = $this->getParam('login');
            $pass = $this->getParam('pass');
            if ($login == 'admin' && $pass == '123')
            {
                setcookie('admin', "admin", time() + 3600 * 24);
                echo 'OK';
            }
            else echo 'Неверный логин или пароль';
        }
    }
}