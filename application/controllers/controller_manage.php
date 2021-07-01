<?php

class Controller_Manage extends Controller
{
    public function action_add()
    {
        $this->checkParams(['user', 'email', 'text']);
        $user = $this->getParam('user');
        $email = $this->getParam('email');
        $text = $this->getParam('text');

        if (!Task::add($user, $email, $text)) echo 'Ошибка добавления';
        else echo 'OK';
    }

    public function action_remove()
    {
        $this->checkParams(['id']);
        echo Task::remove($this->getParam('id')) ? 'OK' : 'Ошибка удаления';
    }

    public function action_update()
    {
        $this->checkParams(['id']);
        $data = array_filter($_POST, function($key){
            return $key != 'id';
        }, ARRAY_FILTER_USE_KEY);
        if (empty($data)) 
        {
            echo "Нет параметров для обновления";
            exit();
        }
        if (!Task::update($this->getParam('id'), $data)) echo 'Ошибка обновления задачи';
        else echo 'OK';
    }
}