<?php

namespace tests;

use App\Model\Pixel;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use App\Service\DatabaseService;

class DatabaseServiceTest extends TestCase
{
    public function testReadQuery()
    {
        $db = new DatabaseService();
        $data = $db->ReadQuery("SELECT * FROM grid");
    }

    public function testInsertQuery(){
        $db = new DatabaseService();
        $db = new DatabaseService();
        $pixel = new Pixel();
        $pixel->setUserId(1);
        $pixel->setXCoordinate(250);
        $pixel->setYCoordinate(250);
        $pixel->setColor("AAAAAA");
        $db->InsertQuery(json_encode($pixel->toArray()));
    }

    public function testUpdateQuery(){
        $db = new DatabaseService();
        $pixel = new Pixel();
        $pixel->setId(1);
        $pixel->setUserId(1);
        $pixel->setXCoordinate(100);
        $pixel->setYCoordinate(60);
        $pixel->setColor("FF33FF");
        $data = $db->UpdateQuery(json_encode($pixel->toArray()));
    }
}
