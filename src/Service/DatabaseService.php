<?php

namespace App\Service;

use App\Config\ConfigDB;
use App\Repository\PixelRepository;
use PDO;

class DatabaseService
{
    protected $connexionPDO;

    protected PixelRepository $pixelRepository;

    public function __construct(){
        $this->connexionPDO = new PDO("mysql:host=".ConfigDB::HOST.";dbname=".ConfigDB::DB_NAME, ConfigDB::USER, ConfigDB::PASSWORD);
        $this->pixelRepository = new PixelRepository($this->connexionPDO);
    }

    /**
     * @return PixelRepository
     */
    public function getPixelRepository(): PixelRepository
    {
        return $this->pixelRepository;
    }
}