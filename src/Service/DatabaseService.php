<?php

namespace App\Service;

use App\Config\ConfigDB;
use App\Model\Pixel;
use PDO;

include_once "..\Config\ConfigDB.php";

/**
 * Service that allow to register, read and update data in database
 */
class DatabaseService
{
    protected $connexionPDO;

    public function __construct(){
        $this->connexionPDO = new PDO("mysql:host=".ConfigDB::HOST.";dbname=".ConfigDB::DB_NAME, ConfigDB::USER, ConfigDB::PASSWORD);
    }

    /**
     * Method to read the data in table Grid
     */
    public function ReadQuery(string $query): string
    {
        $statement = $this->connexionPDO->query($query);
        $rows = $statement->fetchAll(PDO::FETCH_CLASS, Pixel::class);
        //$rows = $statement->fetchAll(PDO::FETCH_SERIALIZE);
        $pixelArray = array_map(function ($pixel) { return $pixel->toArray(); }, $rows);
        return json_encode($pixelArray);
    }

    /**
     * Method to insert data in the table Grid
     */
    public function InsertQuery(string $jsonData) : bool {
        $this->QueryFormat($jsonData, true);
        return true;
    }

    /**
     * Method that we use to register a pixel object in the database
     */
    public function PersistData(/*Pixel $pixel*/string $jsonData){
        $data = json_decode($jsonData);
        $statement = $this->connexionPDO->query("SELECT COUNT(grid_id) FROM grid WHERE grid_id =".$data['grid_id']);
        $singleValue = $statement->fetch(PDO::FETCH_COLUMN);

        if($singleValue > 0){
            $this->UpdateQuery(/*json_encode($pixel->toArray())*/$jsonData);
        }
        else
            $this->InsertQuery(/*json_encode($pixel->toArray())*/$jsonData);
    }

    /**
     * Method to update the table Grid
     */
    public function UpdateQuery(string $jsonData) : bool{
        $this->QueryFormat($jsonData, false);
        return true;
    }

    /**
     * Method that allow to format the query if is an Update or an Insert
     */
    private function QueryFormat(string $jsonData, bool $isInsert){
        $decodeJson = json_decode($jsonData,true);

        $id = $decodeJson['grid_id'];
        $user = $decodeJson['user_id'];
        $x = $decodeJson['x_coordinate'];
        $y = $decodeJson['y_coordinate'];
        $color = $decodeJson['color'];
        $query = NULL;

        if($isInsert)
            $query = "INSERT INTO grid (user_id, x_coordinate, y_coordinate, color) VALUES ({$user}, {$x}, {$y}, '{$color}')";
        else
            $query = "UPDATE grid SET user_id = {$user}, x_coordinate = {$x}, y_coordinate = {$y}, color = '{$color}' WHERE grid_id = {$id} AND user_id = {$user}";

        $this->connexionPDO->query($query);
    }
}