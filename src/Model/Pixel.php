<?php

namespace App\Model;

class Pixel
{
    protected int $id = 0;

    protected int $user_id = 0;

    protected string $color = "FFFFFF";

    protected int $x_coordinate = 0;

    protected int $y_coordinate = 0;

    public function toArray(): array
    {
        return [
            'grid_id' => $this->id,
            'user_id' => $this->user_id,
            'x_coordinate' => $this->x_coordinate,
            'y_coordinate' => $this->y_coordinate,
            'color' => $this->color
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

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
    public function getXCoordinate(): int
    {
        return $this->x_coordinate;
    }

    /**
     * @param int $x_coordinate
     */
    public function setXCoordinate(int $x_coordinate): void
    {
        $this->x_coordinate = $x_coordinate;
    }

    /**
     * @return int
     */
    public function getYCoordinate(): int
    {
        return $this->y_coordinate;
    }

    /**
     * @param int $y_coordinate
     */
    public function setYCoordinate(int $y_coordinate): void
    {
        $this->y_coordinate = $y_coordinate;
    }

}