<?php

namespace App\Repository;

use App\Model\Pixel;
use App\Repository\RepositoryInterface;
use PDO;

class PixelRepository implements RepositoryInterface
{

    protected $connexionPDO;

    function __construct($pdo){
        $this->connexionPDO = $pdo;
    }

    public function getAll(): string
    {
        $statement = $this->connexionPDO->query("SELECT * FROM grid");
        $rows = $statement->fetchAll(PDO::FETCH_CLASS, Pixel::class);
        $pixelArray = array_map(function ($pixel) { return $pixel->toArray(); }, $rows);
        $pixelArray['type'] = "GetAllData";
        return json_encode($pixelArray);
    }

    public function getByID(int $id): string
    {
        $statement = $this->connexionPDO->query("SELECT * FROM grid WHERE grid_id = {$id}");
        $rows = $statement->fetchAll(PDO::FETCH_CLASS, Pixel::class);
        $pixelArray = array_map(function ($pixel) { return $pixel->toArray(); }, $rows);
        $pixelArray['type'] = "GetCurrentData";
        return json_encode($pixelArray);
    }

    public function getByCoordinate(int $x, int $y) : int {
        $statement = $this->connexionPDO->query("SELECT grid_id FROM grid WHERE x_coordinate = {$x} AND y_coordinate = {$y}");
        $id = $statement->fetch(PDO::FETCH_COLUMN);
        return $id;
    }

    public function Save($data): void
    {
        $decodeJson = json_decode($data,true);

        $id = $decodeJson['grid_id'];
        $user = $decodeJson['user_id'];
        $x = $decodeJson['x_coordinate'];
        $y = $decodeJson['y_coordinate'];
        $color = $decodeJson['color'];
        $query = NULL;

        $statement = $this->connexionPDO->query("SELECT COUNT(grid_id) FROM grid WHERE grid_id =".$data['grid_id']);
        $singleValue = $statement->fetch(PDO::FETCH_COLUMN);

        if($singleValue == 0)
            $query = "INSERT INTO grid (user_id, x_coordinate, y_coordinate, color) VALUES ({$user}, {$x}, {$y}, '{$color}')";
        else
            $query = "UPDATE grid SET user_id = {$user}, x_coordinate = {$x}, y_coordinate = {$y}, color = '{$color}' WHERE grid_id = {$id} AND user_id = {$user}";

        $this->connexionPDO->query($query);
    }
}