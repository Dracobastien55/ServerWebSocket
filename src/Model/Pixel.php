<?php

namespace App\Model;

class Pixel
{

    public function __construct(){}

    public function fill(array $row): void
    {
        $this->id = $row['grid_id'];
        $this->color = $row['color'];
        $this->x_coordinate = $row['x_coordinate'];
        $this->y_coordinate = $row['y_coordinate'];
    }

    protected int $id = 0;

    protected string $color = "FFFFFF";

    protected int $x_coordinate = 0;

    protected int $y_coordinate = 0;

    public function toArray(): array
    {
        return [
            'grid_id' => $this->id,
            'x_coordinate' => $this->x_coordinate,
            'y_coordinate' => $this->y_coordinate,
            'color' => $this->color
        ];
    }
}