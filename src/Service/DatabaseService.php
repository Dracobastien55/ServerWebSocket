<?php

namespace App\Service;

use App\Config\ConfigDB;
use PDO;

include_once "..\Config\ConfigDB.php";

class DatabaseService
{
    protected $connexionPDO;

    public function __construct(){
        $this->connexionPDO = new PDO("mysql:host=".ConfigDB::HOST.";dbname=".ConfigDB::DB_NAME, ConfigDB::USER, ConfigDB::PASSWORD);
    }

    public function ReadQuery(string $query): void
    {
        $statement = $this->connexionPDO->query("SELECT x_coordinate, y_coordinate, color FROM grid");
        $rows = $statement->fetchAll(PDO::FETCH_SERIALIZE);
        echo $rows;
    }
}