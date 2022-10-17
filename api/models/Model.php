<?php
namespace Api\Models;

use Api\Core\DataBase;

class Model
{
    private $connection;

    public function __construct()
    {
        $this->connection = DataBase::getConnection();
    }

    public function get($short_name)
    {
        $query = 'SELECT origin FROM urls WHERE short_name=:short_name';
        $sh = $this->connection->prepare($query);
        if (is_array($short_name)) {
            $sh->execute(['short_name' => $short_name['name']]);
        } else {
            $sh->execute(['short_name' => $short_name]);
        }
       
        return $sh->fetch();
    }

    public function set($short_name, $origin)
    {      
        $query = 'INSERT INTO urls (`short_name`, `origin`) VALUES (?, ?)';
        $sh = $this->connection->prepare($query);
        $sh->execute([$short_name, $origin]);
    }
}