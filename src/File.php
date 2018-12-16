<?php

declare(strict_types=1);

namespace OperatingSystem\File;

use OperatingSystem\FileType\FileType;
use OperatingSystem\Group\Factory\GroupFactory;
use OperatingSystem\Permission\Permission;
use OperatingSystem\FileTime\FileTime;
use OperatingSystem\User\Factory\UserFactory;

class File
{
    /**
     * Absolute file path plus file name, for example "/var/www/html/foo.txt".
     *
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        // TODO validate filename

        $this->name = \realpath($name);
    }

    /**
     * System call stat().
     * Clears PHP's stat cache before every time for getting the up to date information.
     *
     * @return array
     */
    private function getStat()
    {
        \clearstatcache();
        return \stat($this->name);
    }

    public function getType()
    {
        return new FileType($this->getStat()['mode']);
    }

    public function getPermissions()
    {
        return new Permission($this->getStat()['mode']);
    }

    public function getLinkCount() // ?
    {

    }

    public function getUser()
    {
        return UserFactory::createFromFileOwner($this->name);
    }

    public function getGroup()
    {
        return GroupFactory::createFromFileGroup($this->name);
    }

    public function getSize()
    {

    }

    public function getTimes()
    {
        return new FileTime($this->name);
    }

    public function getName()
    {
        return $this->name;
    }
}
