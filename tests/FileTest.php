<?php

namespace OperatingSystem\File\Tests;

use OperatingSystem\File\File;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    /**
     * @var File
     */
    protected $file;

    protected function setUp()
    {
        $this->file = new File();
    }

    protected function tearDown()
    {
        $this->file = null;
    }
}
