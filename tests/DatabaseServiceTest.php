<?php

namespace tests;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use App\Service\DatabaseService;

class DatabaseServiceTest extends TestCase
{

    public function testReadQuery()
    {
        $db = new DatabaseService();
        $db->ReadQuery("SELECT * FROM grid");

    }
}
