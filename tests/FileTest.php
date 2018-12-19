<?php

namespace OperatingSystem\File\Tests;

use OperatingSystem\File\File;
use OperatingSystem\FileTime\FileTime;
use OperatingSystem\FileType\FileType;
use OperatingSystem\Group\Group;
use OperatingSystem\Permission\Permission;
use OperatingSystem\User\User;
use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{
    /**
     * @var File
     */
    protected $file;

    protected function setUp()
    {
        $this->file = new File(__FILE__);
    }

    protected function tearDown()
    {
        $this->file = null;
    }

    public function testGetSplFileInfo()
    {
        $this->assertInstanceOf(\SplFileInfo::class, $this->file->getSplFileInfo());
    }

    public function testGetType()
    {
        $this->assertInstanceOf(FileType::class, $this->file->getType());
    }

    public function testGetPermissions()
    {
        $this->assertInstanceOf(Permission::class, $this->file->getPermissions());
    }

    public function testGetUser()
    {
        $this->assertInstanceOf(User::class, $this->file->getUser());
    }

    public function testGetGroup()
    {
        $this->assertInstanceOf(Group::class, $this->file->getGroup());
    }

    public function testGetSize()
    {
        $this->assertIsInt($this->file->getSize());
    }

    public function testGetTimes()
    {
        $this->assertInstanceOf(FileTime::class, $this->file->getTimes());
    }

    public function testGetFilename()
    {
        $filename = $this->file->getFilename();
        $this->assertIsString($filename);
        $this->assertEquals(\basename(__FILE__), $filename);
    }

    public function testGetBasename()
    {
        $basename = $this->file->getBasename();
        $this->assertIsString($basename);
    }

    public function testGetExtension()
    {
        $extension = $this->file->getExtension();
        $this->assertIsString($extension);
    }

    public function testGetPath()
    {
        $path = $this->file->getPath();
        $this->assertIsString($path);
    }

    public function testGetPathWithFilename()
    {
        $pathWithFilename = $this->file->getPathWithFilename();
        $this->assertIsString($pathWithFilename);
    }

    public function testGetRealPath()
    {
        $realPath = $this->file->getRealPath();
        $this->assertIsString($realPath);
    }

    public function testIsReadable()
    {
        $this->assertIsBool($this->file->isReadable());
    }

    public function testIsWriteable()
    {
        $this->assertIsBool($this->file->isWriteable());
    }

    public function testIsExecuteable()
    {
        $this->assertIsBool($this->file->isExecuteable());
    }

    public function testGetInode()
    {
        $this->assertIsInt($this->file->getInode());
    }

    public function testGetLinkTarget()
    {
        $this->expectException(\RuntimeException::class);
        $this->file->getLinkTarget();
    }
}
