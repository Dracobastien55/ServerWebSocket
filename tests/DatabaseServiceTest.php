<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use App\Service\DatabaseService;

class DatabaseServiceTest extends TestCase
{
    public function testReadQueryPixel()
    {
        $db = new DatabaseService();
        $data = $db->getPixelRepository()->getAll();
        $this->assertNotEmpty($data);
    }
}
