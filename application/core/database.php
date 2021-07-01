<?php
include_once(__DIR__ . "/db_config.php");

class DBConnector{
    public mysqli $connector;

    private static $instance = null;

    private function __construct()
    {
        $config = getDBconfig();
        $this->connector = new mysqli($config['host'], $config['user'], $config['pass'], $config['db']);
        $this->createTables();
    }

    private function createTables()
    {
        $query = "CREATE TABLE IF NOT EXISTS `tasks` ( 
            `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL ,
            `user` VARCHAR ( 512 ), 
            `email` VARCHAR ( 1024 ) NOT NULL, 
            `text` VARCHAR ( 2048 ) NOT NULL, 
            `status` VARCHAR ( 64 ) NOT NULL DEFAULT 'new'
        )";
        $this->connector->query($query);
    }

    static public function escape($string)
    {
        $instance = static::getInstanse();
        return $instance->connector->escape_string($string);
    }

    /**
     * @return DBConnector
     */
    public static function getInstanse()
    {
        if (static::$instance == null) static::$instance = new DBConnector();
        return static::$instance;
    }

    public static function exec($query)
    {
        $instance = static::getInstanse();
        return $instance->connector->query($query);
    }

    public static function query($query)
    {
        $instance = static::getInstanse();
        $rows = $instance->connector->query($query);
        if (is_bool($rows)) return $rows;
        $result = [];
        while($row = $rows->fetch_assoc()) $result[] = $row;
        return $result;
    }
}