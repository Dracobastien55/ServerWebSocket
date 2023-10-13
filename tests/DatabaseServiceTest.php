<?php

namespace tests;

use App\Model\Pixel;
use App\Model\User;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use App\Service\DatabaseService;

class DatabaseServiceTest extends TestCase
{
    public function testReadQueryPixel()
    {
        $db = new DatabaseService();
        $data = $db->getPixelRepository()->getAll();
    }

    public function testReadQueryUser(){
        $db = new DatabaseService();
        $data = $db->getUserRepository()->getAll();
    }

    public function testInsertQuery(){
        $db = new DatabaseService();
        $pixel = new Pixel();
        $pixel->setUserId(1);
        $pixel->setXCoordinate(250);
        $pixel->setYCoordinate(250);
        $pixel->setColor("AAAAAA");
        $db->getPixelRepository()->Save(json_encode($pixel->toArray()));
    }

    public function testInsertUserQuery(){
        $db = new DatabaseService();
        $user = new User(1,"Bastien");
        $db->getUserRepository()->Save(json_encode($user->toArray()));
    }
}
