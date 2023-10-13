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
        $pixelArray['data'] = array_map(function ($pixel) { return $pixel->toArray(); }, $rows);
        $pixelArray['type'] = "GetAllData";
        return json_encode($pixelArray);
    }

    public function getByID(int $id): string
    {
        $statement = $this->connexionPDO->query("SELECT * FROM grid WHERE grid_id = {$id}");
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $pixel = new Pixel();
        $pixel->fill($row);
        $pixelArray = $pixel->toArray();
        return json_encode($pixelArray);
    }

    public function getByCoordinate(int $x, int $y) : int {
        $statement = $this->connexionPDO->query("SELECT grid_id FROM grid WHERE x_coordinate = {$x} AND y_coordinate = {$y}");
        $id = $statement->fetch(PDO::FETCH_COLUMN);
        return $id;
    }

    public function save($data): void
    {
        $x = $data['x_coordinate'];
        $y = $data['y_coordinate'];
        $color = $data['color'];
        $query = NULL;

        $id = $this->getByCoordinate($x, $y);

        $statement = $this->connexionPDO->query("SELECT COUNT(grid_id) FROM grid WHERE grid_id =".$id);
        $singleValue = $statement->fetch(PDO::FETCH_COLUMN);

        if($singleValue == 0)
            $query = "INSERT INTO grid (x_coordinate, y_coordinate, color) VALUES ({$x}, {$y}, '{$color}')";
        else
            $query = "UPDATE grid SET x_coordinate = {$x}, y_coordinate = {$y}, color = '{$color}' WHERE grid_id = {$id}";

        $this->connexionPDO->query($query);
    }
}