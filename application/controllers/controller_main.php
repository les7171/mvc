<?php

class Controller_Main extends Controller
{
    public function action_index()
    {
        $sort = $this->getParam('sort', 'id');
        $page = $this->getParam('page', 1);

        $items = Task::getPage($page, $sort);

        $this->view->generate('main_view.php', "template_view.php", [
            'admin' => defined('admin'),
            'items' => $items
        ]);
    }
}