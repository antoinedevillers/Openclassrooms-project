<?php
namespace Openclassrooms\sitesPHP\Openclassroomsproject\projet4\model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        return $db;
    }
}