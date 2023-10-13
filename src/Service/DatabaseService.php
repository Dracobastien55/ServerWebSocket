<?php

namespace App\Service;

use App\Config\ConfigDB;
use App\Repository\PixelRepository;
use App\Repository\UserRepository;
use PDO;

class DatabaseService
{
    protected $connexionPDO;

    protected UserRepository $userRepository;

    protected PixelRepository $pixelRepository;

    public function __construct(){
        $this->connexionPDO = new PDO("mysql:host=".ConfigDB::HOST.";dbname=".ConfigDB::DB_NAME, ConfigDB::USER, ConfigDB::PASSWORD);
        $this->userRepository = new UserRepository($this->connexionPDO);
        $this->pixelRepository = new PixelRepository($this->connexionPDO);
    }

    /**
     * @return UserRepository
     */
    public function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

    /**
     * @return PixelRepository
     */
    public function getPixelRepository(): PixelRepository
    {
        return $this->pixelRepository;
    }


}