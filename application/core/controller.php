<?php

class Controller {
	
	public $model;
	public $view;

	protected $params = [];
	
	function __construct()
	{
		$this->view = new View();
		$this->params = array_merge($this->params, $_GET);
		$this->params = array_merge($this->params, $_POST);
	}

	protected function getParam($key, $default = null)
	{
		return isset($this->params[$key]) ? $this->params[$key] : $default;
	}
	
	function action_index()
	{

	}

	function checkParams($params)
	{
		if (empty($this->params)) exit();
		foreach($params as $param)
		{
			if (!isset($this->params[$param])) 
			{
				echo 'Параметр ' .  $param . " необходим";
				exit();
			}
		}
	}
}
