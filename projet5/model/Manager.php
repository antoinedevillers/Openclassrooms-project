<?php
namespace Projet5\model;

class Manager
{
    protected function dbConnect()
    {
    	$config= parse_ini_file('config.ini');
        $db = new \PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'].';charset=utf8', $config['login'], $config['password']);
       
        return $db;
    }
}