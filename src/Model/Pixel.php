<?php

namespace App\Model;

class Pixel
{
    private string $color;

    private int $x_coordinate;

    private int $y_coordinate;

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return int
     */
    public function getX_Coordinate(): int
    {
        return $this->x_coordinate;
    }

    /**
     * @param int $x
     */
    public function setX_Coordinate(int $x): void
    {
        $this->x_coordinate = $x;
    }

    /**
     * @return int
     */
    public function getY_Coordinate(): int
    {
        return $this->y_coordinate;
    }

    /**
     * @param int $y
     */
    public function setY_Coordinate(int $y): void
    {
        $this->y_coordinate = $y;
    }


}