<?php

foreach(glob(__DIR__ ."/core/*.php") as $file)
{
	require_once($file);
}

foreach(glob(__DIR__ . '/models/*.php') as $file)
{
	require_once($file);
}

if (isset($_COOKIE['admin'])) define('admin', 1);

Router::start(); // запускаем маршрутизатор
