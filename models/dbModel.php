<?php
class dbModel
{
    public function connect()
    {
        $db = new PDO("mysql:host=localhost;dbname=projetweb22;charset=utf8", "root", "");
        return $db;
    }
    public function disConnect()
    {
    }

    public function request($db, $query)
    {
        return $db->query($query);
    }
}